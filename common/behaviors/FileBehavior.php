<?php
namespace common\behaviors;
use nemmo\attachments\behaviors\FileBehavior as Fileb;
use nemmo\attachments\models\File;
use common\helpers\FileHelper;
class FileBehavior extends  Fileb
{
  
   public function dirFile(){
      // return $this->getModule()->getUserDirPath();
   } 
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
   
   public function getFirstImage(){
       
        return (count($this->getImages())>0)?$this->getImages()[0]:null;
   }
   
   public function getImages(){
       $exts= FileHelper::extImages();
        $fileQuery = $this->queryBase->andWhere(['in', 'type', $exts]);
        $fileQuery->orderBy(['id' => SORT_ASC]);

        return $fileQuery->all();
   }
  
 public function  getQueryBase(){
     return File::find()
            ->where([
                'itemId' => $this->owner->id,
                'model' => $this->owner->getShortNameClass()
            ]);
 }
 
 public function getPathFirstImage(){
     if(is_null($this->getFirstImage()) or $this->owner->isNewRecord){
         return FileHelper::UrlEmptyImage();
     }else{
       return $this->firstImage->getUrl();
     }
 }
 
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
     $registros=$this->images;
     foreach($registros as $fila){
        $urlImages[]=$fila->getUrl(); 
     }
     unset($registros);
     return $urlImages;        
     
 }
 
 
}
