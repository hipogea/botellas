<?php

namespace backend\controllers\install;

use Yii;
use yii\web\session;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use console\config\baseTrait;
use yii\helpers\Json;
use backend\components\Installer;

class LanguageController extends Controller
{
  
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function actionIndex()
    {
         $this->layout = 'install';
         if(count(Yii::$app->request->post())>0){
          Installer::setConfigYii('language', Yii::$app->request->post('lang'),Installer::CONFIG_COMMON_LOCAL);
           $this->redirect(Yii::$app->urlManager->createUrl("install/database/create"));
        }
        return $this->render('create');
    }

   
}
