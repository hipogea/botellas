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
use yii\helpers\ArrayHelper;
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
        //$registro= UserFacultades::find()->where(['id'=>27])->one();
        
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
         UserFacultades::refreshTableByUser($iduser);
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
            $this->updateUserFacultades($arrpost[UserFacultades::getShortNameClass()]);
            yii::$app->session->setFlash('success',yii::t('sta.messages','Se grabaron los datos '));
            return $this->redirect(['view-users']);
           }
            //var_dump(h::request()->post());die();
        }
        //echo $model->id;die();
       // var_dump(UserFacultades::providerFacus($iduser)->getModels());die();
        return $this->render('_formtabs', [
            'profile' => $profile,
            'model'=>$newIdentity,
            'userfacultades'=> UserFacultades::providerFacusAll($iduser)->getModels(),
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
    
    
    /*
     * Actualizacion de los valores del aacultades uausuarios 
     */
    private function updateUserFacultades($arrpostUserFac){
        $ar=array_combine(ArrayHelper::getColumn($arrpostUserFac,'id'),
                ArrayHelper::getColumn($arrpostUserFac,'activa'));
        foreach($ar as $clave=>$valor){
           \Yii::$app->db->createCommand()->
             update(UserFacultades::tableName(),
             ['activa'=>$valor],['id'=>$clave])->execute();
        }
        
    }
    
}
