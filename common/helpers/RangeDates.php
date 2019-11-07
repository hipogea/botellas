<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use yii;
 

class RangeDates extends \yii\base\Component{
    
     const ESCALE_SECONDS='Seconds';
    const ESCALE_MINUTES='Minutes';
    const ESCALE_HOURS='Hours';
    const ESCALE_DAYS='Days';
    const ESCALE_WEEKS='Weeks';
     const ESCALE_MONTHS='Meses';
     const ESCALE_YEARS='Years';
    
  /*
   * Esta propiedad define la tolerancia que se aplicara 
   * para la verificación de los decalajes, en decimales
   */  
    
   public $tolerance=0.1; //10%
   /*
    * Array de fechas 
    * [Carbon finicio,Carbon ftermino]
    * de
    * dos objetos Carbon
    */
  public $_dates=[];
   
  
   /*
    * Escala en la que se va a trabajar
    */
   public $scale=self::ESCALE_MINUTES;
   
   
   
   
    public function __construct(Array $dates){
        //var_dump($dates[0]->greaterThanOrEqualTo($dates[1]));die();
        if(count($dates) <> 2)
         throw new \yii\base\Exception(Yii::t('base.errors', 'La propiedad dates Debe de contener {can} elementos',['can'=>2]));
        if(!($dates[0] instanceof \Carbon\Carbon) or 
           !($dates[1] instanceof \Carbon\Carbon))
          throw new \yii\base\Exception(Yii::t('base.errors', 'La propiedad dates debe ser un array debe contener instancias de Carbon'));
         
       if($dates[0]->greaterThanOrEqualTo($dates[1]))           
         throw new \yii\base\Exception(Yii::t('base.errors', 'La fecha de inicio es mayor o igual que la fecha de termino'));
       
   $this->_dates=$dates;
   }
   
   public function getDates(){
       return $this->_dates;
   }
   public function getInitialDate(){
       return $this->_dates[0];
   }
   public function getFinalDate(){
       return $this->_dates[1];
   }
   public function getDuration(){
   return $this->_dates[1]->{$this->getFunctionScale()}($this->_dates[0]);
   }
   
   public function getDiff(\Carbon\Carbon $dateini, \Carbon\Carbon $datefinal){
   return $datefinal->{$this->getFunctionScale()}($dateini);
   }
   
   private function getFunctionScale(){
       return 'diffIn'.$this->scale;
   }
   
}
   
  
   
