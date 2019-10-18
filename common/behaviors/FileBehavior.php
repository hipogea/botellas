<?php
namespace common\behaviors;
use nemmo\attachments\behaviors\FileBehavior as Fileb;
use nemmo\attachments\models\File;
use common\helpers\FileHelper;

/*
 * Esta clase se extiende de la clase original 
 * nemmo\attachments\behaviors\FileBehavior
 * Le ahorrara mucho trabajo al momento de trabajar
 * con archivos adjuntos, en especial sin son imagenes
 * 
 */

class FileBehavior extends  Fileb
{
  
   
   
   
   
   /*
    * Retorna un array de modelos 
    * con la info de archivos adjuntos filtrados por la extension
    * que  usted desea
    */
   public function getFilesByExtension($ext=null){
       if(is_null($ext))
            throw new \yii\base\Exception(Yii::t('base.errors', 'The extension parameter is null'));
        if(substr($ext,0,1)=='.'){
            $ext=substr($ext,1);
        }
        $fileQuery =$this->queryBase->andWhere(['type'=>$ext]);
        $fileQuery->orderBy(['id' => SORT_ASC]);

        return $fileQuery->all();
   }
   
   
   /*Devuelve un modelo
    * representando a la primera image
    * si no tiene adjuntos imagenes 
    * devuelve NULL
    * 
    */
   public function getFirstImage(){
       
        return (count($this->getImages())>0)?$this->getImages()[0]:null;
   }
   
   
    /*
    * Retorna un array de modelos 
    * con la info de archivos adjuntos 
     * Solo imagenes
    */
   public function getImages(){
       $exts= FileHelper::extImages();
        $fileQuery = $this->queryBase->andWhere(['in', 'type', $exts]);
        $fileQuery->orderBy(['id' => SORT_ASC]);

        return $fileQuery->all();
   }
  
   
   /*
    * Devuelve el objecto activeQuery
    * listo para ser usado 
    */
 public function  getQueryBase(){
     return File::find()
            ->where([
                'itemId' => $this->owner->id,
                'model' => $this->owner->getShortNameClass()
            ]);
 }
 
 /*
  * Devuelve la ruta de la imagen 
  * la primera imagen
  * Si no hay imagenes adjuntas 
  * devuelve una imagen anonima a traves de la funcion FileHelper::UrlEmptyImage()
  */
 public function getPathFirstImage(){
     if(is_null($this->getFirstImage()) or $this->owner->isNewRecord){
         return FileHelper::UrlEmptyImage();
     }else{
       return $this->firstImage->getUrl();
     }
 }
 
 /*
  * Devuelve la cantidad de imagenes adjuntas
  */
 public function getCountImages(){
     $exts= FileHelper::extImages();
       return $this->queryBase->andWhere(['in', 'type', $exts])->count();
 }
 
 /*
  * Esta funcion devuelve los UrLS de las 
  * imagenes de los archivos adjuntos 
  */
 public function getUrlFiles(){
     $urlImages=[];
     $registros=$this->files;
     foreach($registros as $fila){
        $urlImages[]=$fila->getUrl(); 
     }
     unset($registros);
     return $urlImages;        
     
 }
 
 
 /*
  * Esta funcion devuelve el
  * Urldel primer adjunto
  * Sea cuakl sea imagen o archivo
  */
 public function getUrlFirstFile(){
    return($this->urlFiles===[])?
     FileHelper::UrlEmptyFile():
        $this->urlFiles[0];
 }
 
 
 /*
  * Borra un archivo adjunto, solo le pasa el id
  * del registro
  */
 public function deleteFile($id){
     $this->getModule()->detachFile($id);
 }
 
 public function sendFileMail(){
   return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject(yii::t('base.verbs','Request password reset') .'  '. Yii::$app->name)
            ->send();  
 }
 
 
 
 
 
}
