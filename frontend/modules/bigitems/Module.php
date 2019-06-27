<?php

namespace frontend\modules\bigitems;
use frontend\modules\bigitems\models\Lugares;

use common\traits\baseTrait;
use yii;
/**
 * bigitems module definition class
 */
class Module extends \yii\base\Module
{
    use baseTrait;
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\bigitems\controllers';

    
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
        /*verificando si existe una configuracion para este modulo
         * 
         */
        // yii::$app->settings->invalidateCache();
        // var_dump(yii::$app->settings->get('bigitems','withPlaces'));
       //var_dump(yii::$app->settings->has('bigitems','withPlaces'));die();
       if(!$this->hasParameterSetting('bigitems','withPlaces')){
         // yii::$app->settings->invalidateCache();
          
           //var_dump(yii::$app->settings->has('bigitems','withPlaces'));die();
           $this->psetting('bigitems','withPlaces', 'false','boolean');
           echo "pimero";die();
       }else{
           //yii::$app->settings->invalidateCache();
         // var_dump($this->gsetting('bigitems', 'withPlaces'));die();
          $this->resolvePlaces(); 
       }

        // custom initialization code goes here
    }
    
    //Deuelve si se esta manejando el transporte conlugares
    // o solo con direcciones 
    public function managePlaces(){
       // var_dump(yii::$app->settings->has('bigitems', 'withPlaces'));die();
        return $this->gsetting('bigitems', 'withPlaces');
    }
    
    private function emptyPlaces(){
        $direccion=Lugares::find()->one();
        //var_dump($direccion);
       return (is_null($direccion))?true:false;
    }
    
    private function resolvePlaces(){
        if(!$this->managePlaces() && $this->emptyPlaces()){
           //echo "holis";die();
         Lugares::insertFirst();  
       }
    }
    
    /*
     * Devuelve un unico valor para los lugares
     * En el caso de que se trabaje solo con direcciones
     * En el caso de que se trabaje con varios lugares este valor sera nulo
     */
    public function getUniquePlace(){
        if($this->managePlaces()){
           return Lugares::find()->one()->id;
        }else{
            return null;
        }
    }
}
