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
use backend\models\install\Database;
class DatabaseController extends Controller
{
  
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function actionCreate()
    {
       
        $this->layout="install"; 
        $model=new Database();
       if ($model->load(Yii::$app->request->post()) && $model->validate()) {           
               if (Installer::createDbTables($model->host, $model->port, $model->database, $model->username, $model->password)) {
            $this->redirect(Yii::$app->urlManager->createUrl("install/settings"));
                  } 
          // $this->redirect(Yii::$app->urlManager->createUrl("install/settings/mail"));
            $model->addError('host', yii::t('install.procedures','There are Errors by connect to Database'));
                  }
        return $this->render('create',['model'=>$model]);
    }

  
}
