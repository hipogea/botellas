<?php

namespace frontend\modules\sta;
use common\helpers\h;
use common\helpers\FileHelper;
use linslin\yii2\curl;
/**
 * sta module definition class
 */
class staModule extends \yii\base\Module
{
    const USER_ALUMNO='10';
    const USER_OTROS='20';
    const RESPONSE_SUCCESS_CODE=200;
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\sta\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public static function isAlumno(){
       if(h::UserIsGuest()){
           return false;
       }else{
          return(h::user()->identity->tipo==self::USER_ALUMNO)?true:false;
           
       }
    }
    
    /*Localiza la ruta de las imagenes 
     * de un servidor remoto mediante un Url
     * 
     */
    public static function getPathImage($codalu){
      
          
    
   
             return self::externalUrlImage($codalu);
        
    }
    
   private static function  externalUrlImage($codalu){
      $extension=h::settings()->get('sta','extensionimagesalu');
        if(!(substr($extension,0,1)=='.'))
         $extension='.'.$extension;
        
      return FileHelper::normalizePath(
             h::settings()->get('sta','urlimagesalu').DIRECTORY_SEPARATOR
            .h::settings()->get('sta','prefiximagesalu') 
            .$codalu
            .$extension,'/');    
   }
   
   private static function  localUrlImage(){
     
        
      return FileHelper::normalizePath(
             h::settings()->get('sta','urlimagesalu').DIRECTORY_SEPARATOR
            .h::settings()->get('sta','prefiximagesalu').DIRECTORY_SEPARATOR 
            .$codalu
            .$extension);    
   }
    
}
