<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use yii;
use common\helpers\h;
use yii\helpers\FileHelper as FileHelperOriginal;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
class FileHelper extends FileHelperOriginal {
    
    public static function extImages(){
        return ['jpg','bmp','png','jpeg','gif','svg','ico'];
    }
    
    public static function getModels($withExt=False){
        //$archivos=self::findFiles(yii::getAlias('@common/models')); 
        $archivox=[];
        //PRINT_R(self::getPathModules());DIE();
        $archivos=array_merge(
                    self::findFiles(yii::getAlias('@common/models')),
                    self::findFiles(yii::getAlias('@backend/models')),
                    self::findFiles(yii::getAlias('@frontend/models')),
                    self::getModelsFromModules()
                );
        foreach($archivos as $k=>$valor){
            if($withExt){
               $archivox[]=self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),DIRECTORY_SEPARATOR);
         
            }else{
              $archivox[]=str_replace('.php','',self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),DIRECTORY_SEPARATOR));
          
            }
            }
        return $archivox;
      }
     
      
      
      public static function getModelsFromModules(){
          $arreglo=[];
        foreach(self::getPathModules() as $k=>$ruta){
           if (is_dir($ruta)){
                    $arreglo=array_merge($arreglo, self::findFiles($ruta));
                        }
            }          
          return $arreglo;
      }
      
      
      
    public static function getPathModules(){
       $ff=[];
        $caminos=array_values(yii::$app->getModules());
        //PRINT_R(ARRAY_VALUES(yii::$app->getModules()));DIE();
        foreach($caminos as $calve=>$valor){
          if(is_array($valor)){
              $ff[]=self::sanitizePath($valor['class']);
          }
        }
         return $ff;   
    }
    
    private function sanitizePath($path){
       $path=trim($path);
        $path=(StringHelper::startsWith($path,'\\'))?substr($path,1):$path;
        $path=(StringHelper::startsWith($path,'/'))?substr($path,1):$path;
          $path=(StringHelper::endsWith($path,'\\'))?substr($path,0,strlen($path)-1):$path;
        $path=(StringHelper::startsWith($path,'/'))?substr($path,strlen($path)-1):$path;
         $separator="/";
        $path=self::normalizePath($path,$separator);
         $position= strpos(strrev($path),$separator);
         $path=substr($path,0,strlen($path)-$position);
         return self::normalizePath(yii::getAlias('@'.$path).$separator.'models',DIRECTORY_SEPARATOR);
    }
      
    /*Devuelve el nombre un archivo de espeficicacion larga
     * vale para especificaciones de clases y rutas de archivos
     *  /Commin/aperded//demas.php  devuelve  demas
     *  /Commin/aperded//demas       devuelve demas  
     */
   public function getShortName($fileName,$delimiter=DIRECTORY_SEPARATOR){
       $fileName=self::normalizePath($fileName,$delimiter);
       RETURN strrev( substr(strrev($fileName),
                            4,
                            (strpos(strrev($fileName),$delimiter)===false)?strlen(strrev($fileName))-4:strpos(strrev($fileName),$delimiter)-4
                                )
                    );
   }
   
   public function getUrlImageUserGuest(){
       $directorio=yii::getAlias('@frontend/web/img').DIRECTORY_SEPARATOR;
       if(!is_dir($directorio))
         throw new \yii\base\Exception(Yii::t('base.errors', 'The  \''.$directorio.'\' Directory doesn\'t exists '));
        if(!is_file($directorio.'anonimus.png'))
       throw new \yii\base\Exception(Yii::t('base.errors', 'The  \''.$directorio.'anonimus.png\' Picture doesn\'t exists '));
        return \yii\helpers\Url::base().'/img/anonimus.png';
   }
   
   /*
    * Arroja la imagen anonima
    */
   public static function UrlEmptyImage(){
       $alias=yii::getAlias('@frontend/web/img/nophoto.png');
       if(!is_file($alias))
       throw new \yii\base\Exception(Yii::t('base.errors', 'The  file {archivo} doesn\'t exists ',['archivo'=>$alias])); 
       return self::normalizePath(\yii\helpers\Url::base().'/img/nophoto.png',DIRECTORY_SEPARATOR);
       
   }
}