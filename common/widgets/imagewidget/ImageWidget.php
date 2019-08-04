<?php
namespace common\widgets\imagewidget;
use common\helpers\FileHelper;
use common\models\base\modelBase;
use kartik\base\TranslationTrait;
//use nemmo\attachments\components\AttachmentsInput;
use yii;
use yii\web\View;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\base\InvalidConfigException;
class ImageWidget extends \yii\widgets\inputWidget
{
    use TranslationTrait;
   public $id;
   public $options;
   public $ancho=100;
   public $alto=100;
   public $pluginOptions;
   public $controllerName='finder';
    public $actionName='selectimage';
     //protected $_msgCat = 'widImage'; //Priedad para hacer cumplir el trait de kartik importado para la internacionalizacion
    
    
   public function run()
    {
       ImageWidgetAsset::register($this->getView());
       $this->initI18N(__DIR__,'widImage');
       $mensaje=yii::t('widImage','This record has a Picture.');
        
            return $this->render('controls',[
               'ancho'=> $this->ancho,
                'alto'=>$this->alto,
                'urlModal'=>\yii\helpers\Url::toRoute(['/'.$this->controllerName.'/'.$this->actionName,'idModal'=>'imagemodal','modelid'=>$this->model->id,'nombreclase'=> str_replace('\\','_',get_class($this->model))]),
                'urlImage'=>$this->getPathFileImage(),
                    'isNew'=>$this->model->isNewRecord,
                    'numeroImages'=>$this->model->getCountImages(),
                    'mensaje'=>$mensaje,
            ]);
        }
       
    
 private function makeJs(){
   
                        }  
  
 private function getPathFileImage(){
     /*
      * Intentamos obtener los archivos adjuntos del modelo
      * Si no tiene el file Atachment behavior oberner una ruta de un archivo sin imagen
      */
     try{
         $files=$this->model->files; //puede arrojar un error porque l modelo no tiene el behavior
     } catch (\yii\base\Exception $ex) {
          throw new \yii\base\Exception(Yii::t('base.errors', 'This model doesn\'t have file Attachment behavior '));  
     }
   if(count($files)==0){
       return FileHelper::UrlEmptyImage();
   }else{
      return $this->model->getPathFirstImage();
   }
   
 }
}
  
?>