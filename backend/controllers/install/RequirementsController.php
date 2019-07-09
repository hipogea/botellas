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



class RequirementsController extends Controller
{
   public function behaviors()
    {
        return [
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    
                ],
            ],
        ];
    }
   
    public function actionIndex(){
        echo "hola";
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function actionShow()
    {
     
        // Check requirements
        $requirements = Installer::checkServerRequirements();

        if (empty($requirements)) {
            // Create the .env file
            
            $this->redirect(\Yii::$app->urlManager->createUrl("install/language/create"));
        } else {
            foreach ($requirements as $requirement) {
                echo $requirement."<br>";
            }

            
        }
    }
}
