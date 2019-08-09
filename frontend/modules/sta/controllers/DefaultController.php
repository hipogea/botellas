<?php

namespace frontend\modules\sta\controllers;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii;
use common\helpers\h;
use common\models\User;
use frontend\modules\sta\models\UserFacultades;
use frontend\modules\sta\models\Facultades;
use mdm\admin\models\searchs\User as UserSearch;
/**
 * Default controller for the `sta` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionProfile(){
        UserFacultades::refreshTableByUser();
        $model =Yii::$app->user->getProfile() ;
       // var_dump($model);die();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           // var_dump($model->getErrors()   );die();
            yii::$app->session->setFlash('success','grabo');
            return $this->redirect(['profile', 'id' => $model->user_id]);
        }else{
           // var_dump($model->getErrors()   );die();
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }
    
    /*
     * Visualiza otros perfiles 
     */
     public function actionViewProfile($iduser){
         UserFacultades::refreshTableByUser();
         $newIdentity=h::user()->identity->findOne($iduser);
      if(is_null($newIdentity))
          throw new BadRequestHttpException(yii::t('base.errors','User not found with id '.$iduser));  
           //echo $newIdentity->id;die();
     // h::user()->switchIdentity($newIdentity);
         
        $profile =$newIdentity->getProfile($iduser);
        $profile->setScenario($profile::SCENARIO_INTERLOCUTOR);
        if(h::request()->isPost){
            $arrpost=h::request()->post();
            $profile->tipo=$arrpost[$profile->getShortNameClass()]['tipo'];
           if ($profile->save()) {
            yii::$app->session->setFlash('success','Se grabaron los datos ');
            return $this->redirect(['view-users']);
           }
            //var_dump(h::request()->post());die();
        }
        //echo $model->id;die();
        return $this->render('_formtabs', [
            'profile' => $profile,
            'model'=>$newIdentity,
            'userfacultades'=> UserFacultades::providerFacus()->getModels(),
        ]);
    }
    
     public function actionViewUsers(){
         $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('users', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionComplete(){
       return $this->render('completar');
    }
    
    
    
}
