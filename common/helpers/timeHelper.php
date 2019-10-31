<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use yii;

class timeHelper {
     
    public static function getMaxTimeExecute(){
      return ini_get('max_execution_time')+0; 
   }
   
   public static function excedioDuracion($duration, $anticipate=0){
      return ($duration + $anticipate >= static::getMaxTimeExecute());
   }
   
   public STATIC function daysOfWeek(){
       return [
           0=>yii::t('base.names','Domingo'),
           1=>yii::t('base.names','Lunes'),
           2=>yii::t('base.names','Martes'),
           3=>yii::t('base.names','Miercoles'),
           4=>yii::t('base.names','Jueves'),
           5=>yii::t('base.names','Viernes'),
           6=>yii::t('base.names','Sabado'),
        
           
       ];
   }
   
   
   public function ff(){
       
   }
   
   
   } 
   
  
   
