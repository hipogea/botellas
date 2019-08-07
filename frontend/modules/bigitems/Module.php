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
    const SE_USA_LUGARES='withPlaces';
    Const MASCARA_CODIGO_PPAL='maskCodeAsset';
    Const MASCARA_CODIGO_SEC='maskCode2Asset';
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
        if(!h::settings()->has($this->id,static::SE_USA_LUGARES)){
          h::settings()->set($this->id,static::SE_USA_LUGARES, 'N');//Colocamos false o N sin lugres por default
          
           }else{
               //echo "aqui";die();
            //  echo "mano"; die();
          //$this->resolvePlaces(); 
       }
       
       //si no existe este parametro crearlo 
       if(!h::settings()->has($this->id,SELF::MASCARA_CODIGO_PPAL))
          h::settings()->set($this->id,SELF::MASCARA_CODIGO_PPAL, '/[A-Z1-9]{1}[A-Z0-9]{8}/');//Colocamos false o N sin lugres por default
        
       //si no exste este parametro crearlo
       if(!h::settings()->has($this->id,SELF::MASCARA_CODIGO_SEC))
          h::settings()->set($this->id,SELF::MASCARA_CODIGO_SEC, '/[A-Z1-9]{1}[A-Z0-9]{8}/');//Colocamos false o N sin lugres por default
        
       
        // custom initialization code goes here
    }
    
    //Deuelve si se esta manejando el transporte conlugares
    // o solo con direcciones 
    public  static function withPlaces(){
       // var_dump(yii::$app->settings->has('bigitems', 'withPlaces'));die();
        return (h::settings()->get(static::getId(), static::SE_USA_LUGARES)=='N')?false:true;
    }
    
    public function behaviors(){
        return[
           /* [
            'class' => FilterLugares::className(), 
              'except' => ['default/complete'],
            ],*/
        ];
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
     
         
        if(!$this::withPlaces() && $this->emptyPlaces()){
          
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
   
   public static function getId(){
       /*Mejorar eta situacion debe de haber algna manera de sacar el ID del modulo*/
       return 'bigitems';
   } 
    
}
