<?php
namespace common\widgets\auditwidget;
use common\models\base\modelBase;
use common\models\audit\Activerecordlog;
use yii\base\Model;
use yii\base\Widget;
use yii\web\View;

use yii\helpers\Url;
use yii\base\InvalidConfigException;
class auditWidget extends Widget
{
    public $id;
    public $controllerName='finder';
    public $actionName='busqueda';
    public $actionNameModal='busquedamodal';
    public $model;//EL modelo
    public $form; //El active FOrm 
    public $campo;//el nombre del campo modelo
    public $foreignskeys=[2,3,4];//Orden de los campos del modelo foraneo 
    //que s evan a amostrar o renderizar en el forumlario eta propida debe de especficarse al momento de usar el widget 
    private $_foreignClass; //nombe de la clase foranea
    private $_foreignField; //nombre del campo foranea
    private $_varsJs=[];
    
    public function init()
    {
        
        parent::init();
        //echo get_class($this->model);die();
        if(!($this->model instanceof Model))
        throw new InvalidConfigException('The "model" property is not subclass from "Model".');
       if($this->model->isNewRecord)
        throw new InvalidConfigException('The "model" property is a New Record');
       
// if(!($this->form instanceof \yii\widgets\ActiveForm))
        //throw new InvalidConfigException('The "form" property is not subclass from "ActiveForm".');
  
        //$this->_foreignClass=$this->model->obtenerForeignClass($this->campo);
        //$this->_foreignField=$this->model->obtenerForeignField($this->campo);

    }

    public function run()
    {
        
        


// Register AssetBundle
        searchWidgetAsset::register($this->getView());
        $this->makeJs();
        if($this->model->isNewRecord){
          return  $this->render('controls',[
                'model'=>$this->model,
                'form'=>$this->form,
                'campo'=>$this->campo,
                'valores'=>$this->getValuesForaneos(),
                'idcontrolprefix'=>$this->getIdControl(),
                ]);
        }else{
             return  $this->render('controls',[
                'model'=>$this->model,
                'form'=>$this->form,
                'campo'=>$this->campo,
                'valores'=>$this->getValuesForaneos(),
                 'idcontrolprefix'=>$this->getIdControl(),
                ]);
        }
       // return $this->render('controls', ['product' => $this->model]);
    }
    
    public function getValuesForaneos(){
        $modelForeign=$this->getModelForeign();
        
       $valoresForaneos=[];
       $i=0;
        foreach($modelForeign->attributes as $name=>$valor){
          if(in_array($i,$this->foreignskeys))
            $valoresForaneos[$name]=[
                  'label'=>$modelForeign->getAttributeLabel($name),
                   'value'=>!is_null($modelForeign->{$name})?$modelForeign->{$name}:'',
             ];
                            $i++;
        }
        //VAR_DUMP($valoresForaneos);DIE();
        
        return $valoresForaneos;
        }
       
         
 private function getModelForeign(){
     if($this->model->isNewRecord){
             $modelForeign=new $this->_foreignClass;
            }else{
            $modelForeign=$this->_foreignClass::find()->where([
                $this->_foreignField=>
                $this->model->{$this->campo}
                                                            ])->one();                                                        
        }
     return $modelForeign;
 }       
        
  private function makeJs(){
    $stringJs=" $('#".$this->getIdControl()."').on( 'change', function() {"
            . "  $.ajax({
              url: '".\yii\helpers\Url::toRoute($this->controllerName.'/'.$this->actionName)."',
              type: 'POST',
              dataType: 'JSON',
              data: {modeloname: '".str_replace('\\','_',$this->_foreignClass)."',campoclave:'".$this->_foreignField  ."' ,valorclave:$('#".$this->getIdControl()."').val()  },
              beforeSend: function() {
                           
                        },
               error: function(json) {
                           
                        },         

              success: function(json) {
                         fila=json['row']; //TOMAMOS LA FILA DEVUELTA
                         //RECORRIENDO LOS CAMPOS Y LLENANDO SUS VALORES 
                         $.each(fila, function( index, value ) {
                         $('#adicional-'+index).val(value);                       
                                });
                      
                        }
              });  "
            . ""
            . " }); ";
    $url=Url::toRoute(['/'.$this->controllerName.'/'.$this->actionNameModal,
       //
        //'nombrecampo'=>$this->_foreignField,
        'nombrecontrol'=>$this->getIdControl(),
        'nombremodelo'=>str_replace('\\','_',$this->_foreignClass),
        'nombrecampoforaneo'=>$this->_foreignField,
        
        // 'nombredialogo'=>'dialog-'.$this->getIdControl(),
       
        ]);
    $stringJs2=' $("#btn-'.$this->getIdControl().'").on("click", function() {     
    
$("#iframe-'.$this->getIdControl().'").attr("src","'.$url.'"); 
          $("#modal-'.$this->getIdControl().'").dialog("open");       
            }); ';
  // echo  \yii\helpers\Html::script($stringJs);
   $this->getView()->registerJs($stringJs);
    $this->getView()->registerJs($stringJs2);
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
   
   
}

?>