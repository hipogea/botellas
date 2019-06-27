<?php 

namespace console\controllers;
use yii\console\Controller;

class saludoController extends Controller
{
    public $message;
    
    public function init(){
        
       
        return parent::init();
    }
    public function options($actionID)
    {
        return ['message'];
    }
    
    public function optionAliases()
    {
        return ['m' => 'message'];
    }
    
    public function actionIndex()
    {
        echo "hola";
    }
}
?>