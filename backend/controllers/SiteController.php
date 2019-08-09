<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\masters\Documentos;
use common\traits\baseTrait;
use yii\helpers\Json;
use console\components\Command;

use backend\components\Installer;
/**
 * Site controller
 */
class SiteController extends Controller
{
    use baseTrait;
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        /*return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];*/
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       if(Installer::isFileEnv()){            
            if(!Installer::alreadyInstalled()){
                return  Yii::$app->controller->redirect(['install/language'])->send();
             }
        }else{
           
            if(static::isFileEnvExample()){
                //copiar al archivio .env
                 Installer::createDefaultEnvFile();
                 //redirigr al instalador
                Installer::redirectInstall();
            }else{
                //lanzar el error 
                throw new \yii\base\Exception(
                   yii::t('install.errors','The  \'.env.example\' file  don\'t exists, please check for it')
                   ); 
            }
            
        }
           
        if(!Yii::$app->user->isGuest)        
          return $this->render('index');     
          $this->redirect('login');
       
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout='install';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('loginSite', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    
    
    public function actionHola()
    {
        echo ('hola');
    }
    
    private function verifyInstalled(){
        
    }
}
