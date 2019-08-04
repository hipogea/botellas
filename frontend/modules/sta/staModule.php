<?php

namespace frontend\modules\sta;
use common\helpers\h;
use frontend\modules\sta\components\Profile;
use frontend\modules\sta\models\StaInterlocutor;
use common\helpers\FileHelper;
use frontend\modules\sta\filters\FilterComplete;
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
    public function behaviors(){
        return[
           /* [
            'class' => FilterComplete::className(), 
              'except' => ['default/complete'],
            ],*/
        ];
    }
    
    
    public function init()
    {
        parent::init();
        
        /*if(is_null(static::getInterlocutor())){
             //var_dump(\yii::$app->controller)  ;die();
        }
           */
      //  h::app()->controller->redirect(['/sta/default/completar']);

        // custom initialization code goes here
    }
    
    public static function getProfile(){
        return Profile::find()->where(['user_id'=>h::userId()])->one();
    }
    public static function getInterlocutor(){
        $reg=static::getProfile();
       // var_dump($reg->attributes);die();
        if(is_null($reg)){
            return null;
        }else{
           return  StaInterlocutor::find()->where(['profile_id'=>$reg->id])->one();
        }
        //return (is_null($reg))?null:StaInterlocutor::find()->where(['profile_id'=>$reg->id])->one();
    }
   public function hasInterlocutor(){
       return (is_null(static::getInterlocutor()))?false:true;
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
