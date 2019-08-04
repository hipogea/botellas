<?php
namespace frontend\controllers\base;
use Yii;
use common\helpers\h;
use yii\web\Controller;
use yii\helpers\Html;
/**
 * CliproController implements the CRUD actions for Clipro model.
 */
class baseController extends Controller
{
   public $nameSpaces=[];
   
    /*
     * Estas constante son predefinidas en 
     * los widgets edit-xxx
     */
    const EDIT_HAS_EDITABLE='hasEditable';
    const EDIT_ARBITRARY='XXY4';
    const EDIT_EDITABLE_KEY='editableKey';
     const EDIT_EDITABLE_INDEX='editableIndex';
     const EDIT_EDITABLE_ATTRIBUTE='editableAttribute';  
    

 /*
  * Procedimiento para gestionar los POSTS Ajax
  * de los controles edit-Field, edit-column
  * Siempre invoque esta funcion dentro de los action
  * en las clases  hijas que reciban los valores POST 
  * de los Ajax de los widgets edit-xxxx
  */
 public function editField(){
     // var_dump(h::request()->post());die();
       // var_dump($this->getNamespace($this->findKeyArrayInPost()));die();
        $className=$this->getNamespace($this->findKeyArrayInPost());
      $model=$className::findOne( h::request()->post(static::EDIT_EDITABLE_KEY));
        // use Yii's response format to encode output as JSON
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model->{h::request()->post(static::EDIT_EDITABLE_ATTRIBUTE)}=h::request()->
                post($this->findKeyArrayInPost())[h::request()->
                post( static::EDIT_EDITABLE_INDEX  )][h::request()->post(static::EDIT_EDITABLE_ATTRIBUTE)];
     
         if ($model->load($_POST)) {        
        if ($model->save()) {
             return  \yii\helpers\Json::encode(['output'=>'OK', 'message'=>'SE EDITO SIN PROBLEMAS']);
             }
       else {
           RETURN  ['output'=>'Error', 'message'=>$model->getFirstError()];
        }}else {
             return ['output'=>'', 'message'=>''];
        }
   
  }
     
  /*
   * Verifica que el controlador esta recibiendo 
   * un POST AJAX de un widget edit-xxxx
   */
 public function is_editable(){
     return (!(h::request()->post(static::EDIT_HAS_EDITABLE,
            static::EDIT_EDITABLE_ATTRIBUTE)
            ===static::EDIT_EDITABLE_ATTRIBUTE)); 
 }
  
private function getNamespace($modelclass){
$clase=null;
if(count($this->nameSpaces)==0)
    RETURN $modelclass;
    //throw new \yii\base\Exception(Yii::t('base.errors', 'You should define  \'namespaces\'[]  property for this controller '));
         
       foreach($this->nameSpaces as $indice=>$namespace){
        if (class_exists($namespace."\\".$modelclass)){
           $clase=$namespace."\\".$modelclass; break;
        }
    }
    return $clase;
if($clase===null)
    throw new \yii\base\Exception(Yii::t('base.errors', 'No namespace found in namespaces[] property that matches with the {nombreclase}, please review this propertie ',['{nombreclase}'=>$modelclass]));
         
    
}

/*ENCUENTRA EL NOMBRE DEL MODELO
 * EN EL POST DEL AJAX ENVIADO POR
 * LOS WIDGETS EDIT-XXX
 */
    
private static function findKeyArrayInPost(){
     $arr=h::request()->post();
     $valor=null;
     foreach ($arr as $key=>$value){
         if(is_array($value)){
             $valor=$key;break;
         }             
     }
     return $valor;
 }    


 /*Cierra la ventana modal y refresca las
  * grillas de la ventana padres 
  * @nombremodal: Nombre de la ventana Modal
  * @grillas: Array con el nombre de las grillas
  */
 public function closeModal($nombremodal,$grillas=null){
     if(is_array($grillas)){
         echo Html::script(" $('#".$nombremodal."').modal('hide');"); 
         foreach($grillas as $v=>$grilla){
           echo Html::script("window.parent.$.pjax({container: '#".$grilla."'});");   
         }
     
     }elseif(is_null($grillas)){
        echo Html::script(" $('#".$nombremodal."').modal('hide');");   
     }else{
        echo Html::script(" $('#".$nombremodal."').modal('hide'); "
             . "window.parent.$.pjax({container: '#".$grillas."'})"); 
     }
  
 }
 

}
