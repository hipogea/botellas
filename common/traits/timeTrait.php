<?php
/*
 * TRAIT DE USO general para saber 
 * por ejemplo si una feha e sferiado o no
 */
namespace common\traits;
use yii;
use Carbon\Carbon;
use common\helpers\RangeDates;
trait timeTrait
{
    private $_holyDays=[
        '2019-01-01',
        '2019-10-08',
        '2019-05-01',
        '2019-06-29',
        '2019-07-28',
        '2019-07-29',
        '2019-08-30',
        '2019-11-01',
        '2019-12-25',
        '2020-01-01',
        '2020-10-08',
        '2020-05-01',
        '2020-06-29',
        '2020-07-28',
        '2020-07-29',
        '2020-08-30',
        '2020-11-01',
        '2020-12-25',
             ];

    private function getHolyDays(){
        return $this->_holyDays;
    }
    
    public function isHolyDay(Carbon $fecha){
        return (in_array($fecha->format('Y-m-d'),$this->getHolyDays()))?true:false;
    }
    
    /*
     * PARA SABER SI UNA FEHA ESTA DENTRO UN INTERVALO
     */
    public function betweenDate( Carbon $fecha,
                             Carbon $finicio,
                             Carbon $ftermino,
                        $withBorder=true){
         if($withBorder){
             return($fecha->greaterThanOrEqualTo($finicio) && 
            $fecha->lessThanOrEqualTo($ftermino))?true:false;
         }else{
            return($fecha->greaterThan($finicio) && 
            $fecha->lessThan($ftermino))?true:false; 
         }
        
    }
    
    /*
     * PARA SABER SI UN RANGOD E FECHAS 
     * ESTA CONTENIDO EN OTRO RANGO DE FECHAS
     * $rango  : DateRange  , rango que se va a buscar
     * $hostRango: DateRango rango donde se va a buscar 
     * Devuelve 
     * true: Quiere decir que si opuede considerarse dentro del valordel rango a bsucar
     * false: eSTA Fuera delos valores del rango a bsucar 
     */
    public function isRangeIntoOtherRange(RangeDates $rangeCompare, //rango a buscar
            RangeDates $rangeSearch, //rANGO A COMPARAR 
            $withBorder=true){
         return (
                 $this->intofisrtCondition($rangeCompare, $rangeSearch, $withBorder) &&
                 (
                  $this->intoSecondCondition($rangeCompare, $rangeSearch) or
                  $this->intoThirdCondition($rangeCompare, $rangeSearch) or
                  $this->intoFourthCondition($rangeCompare, $rangeSearch)
                   )
                 );
    }
   
    
    /*
     * Saber si el rango a comparar  no esta fuera de las fronteras del rango
     * a buscar
     * 
     */
  private function intofisrtCondition(RangeDates $rangeCompare, 
          RangeDates $rangeSearch,$withBorder=true){
      if($withBorder){
           return !($rangeCompare->finalDate->lessThanOrEqualTo($rangeSearch->initialDate) or
             $rangeCompare->initialDate->greaterThanOrEqualTo($rangeSearch->finalDate)); 
             
         }else{
            return !($rangeCompare->finalDate->lessThan($rangeSearch->initialDate) or
             $rangeCompare->initialDate->greaterThan($rangeSearch->finalDate));        
         }
  }

private function intoSecondCondition(RangeDates $rangeCompare, 
          RangeDates $rangeSearch){      
         return (($rangeCompare->diff($rangeCompare->finalDate,$rangeSearch->initialDate) >= (1-$rangeCompare->tolerance)*$rangeCompare->duration) &&
           ($rangeCompare->initialDate->lessThanOrEqualTo($rangeSearch->initialDate))
           );
           
  }
 
  private function intoThirdCondition(RangeDates $rangeCompare, 
          RangeDates $rangeSearch){      
         return (($rangeCompare->initialDate->greaterThanOrEqualTo($rangeSearch->initialDate)) &&
           ($rangeCompare->finalDate->lessThanOrEqualTo($rangeSearch->finalDate))
           );
           
  }

  
  private function intoFourthCondition(RangeDates $rangeCompare, 
          RangeDates $rangeSearch){      
         return (($rangeCompare->diff($rangeCompare->finalDate,$rangeSearch->finalDate) >= (1-$rangeCompare->tolerance)*$rangeCompare->duration) &&
           ($rangeCompare->initialDate->lessThanOrEqualTo($rangeSearch->finalDate))
           );
           
  }
  
  /*Verifica que rangecompare
   * no coincide en nada con 
   * RangeSearch, es decir NO SE TRASLAPAN
   */
  public function traslape(RangeDates $rangeCompare, 
          RangeDates $rangeSearch){
      return !($rangeSearch->initialDate->greaterThan($rangeCompare->finalDate) or
       $rangeCompare->initialDate->greaterThan($rangeSearch->finalDate));
  }
  
}
