<?php
namespace frontend\modules\bigitems\traits;
use common\helpers\h;
use yii;
trait assetTrait
{

    
    
    public function init(){
             
        return parent::init();
    }
    
   public function withPlaces(){
       return h::app()->getModule(
               h::app()->controller->module->id
               )::withPlaces();
       //var_dump(yii::$app->getModule(Yii::$app->controller->module->id)::withPlaces());die();
       
   }

}
