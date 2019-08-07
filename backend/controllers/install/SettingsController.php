<?php
namespace backend\controllers\install;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use console\config\baseTrait;
use yii\helpers\Json;
use backend\components\Installer;
use common\models\masters\Sociedades;
use backend\models\install\Database;
use backend\models\install\Settings;
use common\traits\baseTrait AS BASET;
class SettingsController extends Controller
{
  use BASET;
    
  public function init(){
      $this->layout = 'install';
      return parent::init();
  }
  public function actions()
    {
        return [
            'create-parameter' => [
                'class' => \yii2mod\settings\actions\SettingsAction::class,
                'sectionName'=>'formats',
                // also you can use events as follows:
                'on beforeSave' => function ($event) {
                    // your custom code
                },
                'on afterSave' => function ($event) {
                   
                        Yii::$app->response->redirect(Yii::$app->urlManager->createUrl("/"))->send();
                     
                   
                   //$this->redirect(Yii::$app->urlManager->createUrl("index"));
               
                },
                'modelClass' => \app\models\Setting::class,
            ],
        ];
    }
  
  
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function actionIndex()
    {
    
        $model=New Settings(['scenario'=>'company']);
         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           yii::$app->session->set('codmon',$model->moneda);
            $comp=New Sociedades();            
            $vale=$comp->firstOrCreate(['socio'=>'B','rucsoc'=>$model->rucCompany,'dsocio'=>$model->companyName,'mail'=>$model->emailCompany]);
           $this->redirect(Yii::$app->urlManager->createUrl("install/settings/mail"));
        }
        return $this->render('create',['model'=>$model]);
    }

    public function actionMail(){
       
        $model=New Settings(['scenario'=>'mail']);
         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             $mensaje=Installer::testMail($model->serverMail,$model->userMail,$model->passwordMail,$model->portMail);
           if($mensaje==""){               
           $this->redirect(Yii::$app->urlManager->createUrl("install/settings/user"));
               }else{
               $model->addError('serverMail', $mensaje);
           }
            
        }
        return $this->render('mail',['model'=>$model]);
    }
    
   public function actionUser(){
        
    
        $model = new \mdm\admin\models\form\Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                  yii::$app->session['newUser']=$user->id;
                  
                  /*N s aseguramos que ea un ausuario activo; 
                   * porque puede ser que en los parametros de confuracion de archivo lo hayan colocado como inactio
                   * por default= inactive
                   */
                 $user->status=\mdm\admin\models\User::STATUS_ACTIVE;
                 $user->save();
                /*
                 * ACA PONEMOS LOS TOQUES FINALES Y TERMINAMOS 
                 * CON LA CONFIGURACION EN CALIENTE 
                 */
                
               Installer::finalTouches();
               Installer::createBasicRole(); 
                
                $this->redirect(\Yii::$app->urlManager->createUrl("site/index"));
            }
        }

        return $this->render('signup', [
                'model' => $model,
        ]);
    }
   
    


}
