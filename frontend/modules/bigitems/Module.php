<?php

namespace frontend\modules\bigitems;
use frontend\modules\bigitems\models\Lugares;
use common\helpers\h;
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
    //public $requireDirecciones=false; ///si requiere el uso de lugares o (solo direccines=false)
    
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        /*verificando si existe una configuracion para este modulo
         * 
         */
       // h::settings()->invalidateCache();
        
        //  h::settings()->invalidateCache();
       // var_dump(h::settings()->has('bigitems','withPlaces'));die();
        if(!h::settings()->has('bigitems','withPlaces')){
          h::settings()->set('bigitems','withPlaces', 'N');//Colocamos false o N sin lugres por default
          
           }else{
               //echo "aqui";die();
            //  echo "mano"; die();
          $this->resolvePlaces(); 
       }

        // custom initialization code goes here
    }
    
    //Deuelve si se esta manejando el transporte conlugares
    // o solo con direcciones 
    public static function withPlaces(){
       // var_dump(yii::$app->settings->has('bigitems', 'withPlaces'));die();
        return (h::settings()->get('bigitems', 'withPlaces')=='N')?false:true;
    }
    
    
    /*varifica si la tbla lugares esta vacia */
    private function emptyPlaces(){
        //$direccion=;
        //var_dump($direccion);
       return (is_null(Lugares::find()->one()))?true:false;
    }
    
    /* Se fija si esta configurado para no manejar lugares
     * y ademas no hay ningu registro en la tala lugares 
     * quiere decir que debsmos insertar un vaor cualquiera para hacer cumplir la
     * integridad referencial
     */
    private function resolvePlaces(){
     
         
        if(!$this->withPlaces() && $this->emptyPlaces()){
          
         Lugares::insertFirst();  
       }
    }
    
    /*
     * Devuelve un unico valor para los lugares
     * En el caso de que se trabaje solo con direcciones
     * En el caso de que se trabaje con varios lugares este valor sera nulo
     */
    public static function getUniquePlace(){
        if(!static::withPlaces()){
           return Lugares::find()->one()->id;
        }else{
            return null;
        }
    }
}
