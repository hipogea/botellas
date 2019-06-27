<?php
namespace common\widgets\selectwidget;
use common\models\base\modelBase;
use yii\base\Widget;
use yii\web\View;

use yii\helpers\Url;
use yii\base\InvalidConfigException;
class selectWidget extends \yii\base\Widget
{
    public $id;
    public $controllerName='finder';
    public $actionName='searchselect';
    //public $actionNameModal='busquedamodal';
    public $model;//EL modelo
    public $form; //El active FOrm 
    public $campo;//el nombre del campo modelo
   // public $foreignskeys=[2,3,4];//Orden de los campos del modelo foraneo 
    //que s evan a amostrar o renderizar en el forumlario eta propida debe de especficarse al momento de usar el widget 
    private $_foreignClass; //nombe de la clase foranea
    private $_foreignField; //nombre del campo foranea
    private $_secondField=null; //el  nombde del campo oraneo a mosrtar en el comno
    //private $_varsJs=[];
    public $ordenCampo=1; //EL campo a mostrar por el combo 
    private $_modelForeign=null; //El obejto modelo foraneo
    
    public function init()
    {
        
        parent::init();
        // echo get_class($this->model);die();
        if(!($this->model instanceof modelBase))
        throw new InvalidConfigException('The "model" property is not subclass from "modelBase".');
        if(!($this->form instanceof \yii\widgets\ActiveForm))
        throw new InvalidConfigException('The "form" property is not subclass from "ActiveForm".');
  
        $this->_foreignClass=$this->model->obtenerForeignClass($this->campo);
        $this->_foreignField=$this->model->obtenerForeignField($this->campo);
           //var_dump( $this->_foreignClass);die();
    }

    public function run()
    {
         // Register AssetBundle
        selectWidgetAsset::register($this->getView());
        $this->makeJs();
        if($this->model->isNewRecord){
            //$valores=[];
          return  $this->render('controls',[
                'model'=>$this->model,
                'form'=>$this->form,
                'campo'=>$this->campo,
                 'esnuevo'=>$this->model->isNewRecord,
               'valoresLista'=>$this->getValoresList(),
             // 'valores'=>$valores,
               // 'idcontrolprefix'=>$this->getIdControl(),
                ]);
        }else{
            //$valores=[$model->{$campo}=>
            //$this->getModelForeign()->{$this->getSecondField()}];
             return  $this->render('controls',[
                'model'=>$this->model,
                'form'=>$this->form,
                'campo'=>$this->campo,
                  'esnuevo'=>$this->model->isNewRecord,
                 'valoresLista'=>$this->getValoresList(),
               //  'valores'=>$valores,
               //  'idcontrolprefix'=>$this->getIdControl(),
                ]);
        }
       // return $this->render('controls', ['product' => $this->model]);
    }
    
 private function makeJs(){
   $this->getView()->registerJs("$(document).ready(function() {
    $('#".$this->getIdControl()."').select2( 
    {
  ajax: { 
   url: '".\yii\helpers\Url::toRoute($this->controllerName.'/'.$this->actionName)."',
   type: 'post',
   dataType: 'json',
   delay: 250,
 data: function (params) {
      var query = {
        searchTerm: params.term,
        model: '".str_replace('\\','_',get_class($this->getModelForeign()))."',
        firstField: '".$this->_foreignField."',
        secondField: '".$this->getSecondField()."',
        thirdField:'',
      }

      // Query parameters will be ?search=[term]&type=public
      return query;
    },
   processResults: function (response) {
     return {
        results: response
     };
   },
   cache: true
  }
 }

);
     
    
});",\yii\web\View::POS_END);
                        }     
        
     private function getModelForeign(){
     if(is_null($this->_modelForeign)){
        if($this->model->isNewRecord){
             $modelForeign=new $this->_foreignClass;
            }else{
            $modelForeign=$this->_foreignClass::find()->where([
                $this->_foreignField=>
                $this->model->{$this->campo}
                                                            ])->one();                                                        
        }
        $this->_modelForeign=$modelForeign; unset($modelForeign);       
     }
    return  $this->_modelForeign;
 }      
   
   
   private function getShortNameModel(){
       $retazos=explode('\\',get_class($this->model));
      return $retazos[count($retazos)-1];
   }
   
   /*
    * Obtiene el nombre del control del form
    * Ejemplo:  clipro-codpro
    * Es el Id del control en el Form
    */
   private function getIdControl(){
       return strtolower($this->getShortNameModel().'-'.$this->campo);
   }
      
    
   private function getSecondField(){
       if(is_null($this->_secondField)){
          $model=$this->getModelForeign();
          $this->_secondField=array_keys($model->attributes)[$this->ordenCampo];
        return  $this->_secondField;
       }
       return $this->_secondField;
       
   }
   
   private function getValoresList(){
       if($this->model->isNewRecord){
           return [];
       }
       return [
           $this->getModelForeign()->{$this->_foreignField}=>
           $this->getModelForeign()->{$this->getSecondField()}
           ];
   }
           
   
}
?>