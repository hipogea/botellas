<?php

namespace console\components;
use yii\base\Component;
use yii\helpers\ArrayHelper;
Class Command extends Component{    
    const ROUTE_CONFIG_COMMON=__DIR__.'/../../common';
    const ROUTE_CONFIG_CONSOLE=__DIR__.'/../config';
    
    
    public static function execute($action,$params){
        ob_start();
        $oldApp = \Yii::$app;
        $newApp=static::getNewApp(static::getConfig());
        $newApp->runAction($action,$params);
         \Yii::$app = $oldApp; 
          return ob_get_clean();
    }
    
    private static function getConfig(){
        $config= ArrayHelper::merge(
    require static::ROUTE_CONFIG_COMMON.'/config/main.php',
    require static::ROUTE_CONFIG_COMMON.'/config/main-local.php',
    require static::ROUTE_CONFIG_CONSOLE.'/main.php',
    require static::ROUTE_CONFIG_CONSOLE.'/main-local.php'   
        );
        //$config['components']['db']=\Yii::$app->db;
        return $config;
    }
    
    private static function getNewApp($config){       
    return new \yii\console\Application($config);           
    }
}

