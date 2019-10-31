<?php
/**
 * Creado por Julian Ramirez
 * hipogea@hotmail.com
 * Si lo usas en tu app  pon los creditos CTM
 * no seas conchan 
 */

namespace common\behaviors;
use yii;
use Carbon\Carbon;
use yii\base\Behavior;
use yii\helpers\Json;
//use common\models\audit\Activerecordlog;
use yii\db\ActiveRecord;
use \yii\web\ServerErrorHttpException;

class RAngeTimesBehavior extends Behavior
{
    
    const ESCALE_SECONDS='seconds';
    const ESCALE_MINUTES='minutes';
    const ESCALE_HOURS='hours';
    const ESCALE_DAYS='days';
    const ESCALE_WEEKS='weeks';
     const ESCALE_MONTHS='meses';
     const ESCALE_YEARS='years';
    
  /*
   * Esta propiedad define la tolerancia que se aplicara 
   * para la verificación de los decalajes, en decimales
   */  
    
   public $tolerance=0.1; //10%
   /*
    * Array de fechas 
    * ['finicio','ftermino']
    * Donde 'finicio', 'ftermino' pueden 
    * ser dos cadenas o dos objetos Carbon
    */
   public $range=[];
   
  
   /*
    * Escala en la que se va a trabajar
    */
   public $scale=self::ESCALE_MINUTES;
   
   
   
   
   
  
}