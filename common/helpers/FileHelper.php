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
   
    const NOT_FOUND_MESSAGE='HTTP/1.1 404 Not Found';
    public static function extImages(){
        return ['jpg','bmp','png','jpeg','gif','svg','ico'];
    }
    
    
    public static function getModelsByModule($moduleName,$withExt=False){
        //$archivos=self::findFiles(yii::getAlias('@common/models')); 
        $archivox=[];
        //PRINT_R(self::getPathModules());DIE();
        $archivos=self::getModelsFromModules($moduleName);
        foreach($archivos as $k=>$valor){
            if($withExt){
               $archivox[]=self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),'\\');
         
            }else{
              $archivox[]=str_replace('.php','',self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),'\\'));
          
            }
            }
        return $archivox;
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
               $archivox[]=self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),'\\');
         
            }else{
              $archivox[]=str_replace('.php','',self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),'\\'));
          
            }
            }
        return $archivox;
      }
     
      
      
      public static function getModelsFromModules($moduleName=null){
          $arreglo=[];
        foreach(self::getPathModules($moduleName) as $k=>$ruta){
           
           if (is_dir($ruta)){
                 //echo "l ruta  -> ".$ruta."<br>";
                    $arreglo=array_merge($arreglo, self::findFiles($ruta));
                        }
            }          
          return $arreglo;
      }
      
      
      
    public static function getPathModules($moduleName=null){
         $ff=[];
         $caminos=array_values(yii::$app->getModules()); 
         if(!is_null($moduleName)){
          //return  var_dump(yii::$app->getModules()[$moduleName]); 
            // print_r(array_values($caminos));die();
             //foreach($caminos as $calve=>$valor){
         $ff[]=self::preparePathForFindModels(yii::$app->getModules()[$moduleName]::className());
            return $ff;
          // print_r(yii::$app->getModules()[$moduleName]::className());die();
                          }
        // }
         
        //PRINT_R(ARRAY_VALUES(yii::$app->getModules()));DIE();
        foreach($caminos as $calve=>$valor){
            
          if(is_array($valor)){
             
              
              $ff[]=self::preparePathForFindModels($valor['class']);
          }
        }
         return $ff;   
    
    }
    
    /*
     * Esta funcion se encarga de arreglar las rutas cortas
     * de los nombres de clases u otra rutas y los convierte
     * a rutas absolutas; pero le agrega ua subraiz 'models' , todo esto con el fin 
     * de que puedan verificarse los archivos con la funcion FIndFiles()
     * al momento de buscar modelos
     * ejemplo: 
     * 
     *     "frontend/sta\\midirectorio" => 
     *     "/home/wwwcase/public_html/frontend/sta/models"
     * 
     * 
     */
    private function preparePathForFindModels($path){
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
   public static function getShortName($fileName,$delimiter=DIRECTORY_SEPARATOR){
       $className = $fileName;
       if (preg_match('@\\\\([\w]+)$@', $fileName, $matches)) {
            $className = $matches[1];
        }
        return $className;
     /*  
       $fileName=self::normalizePath($fileName,$delimiter);
       RETURN strrev( substr(strrev($fileName),
                            4,
                            (strpos(strrev($fileName),$delimiter)===false)?strlen(strrev($fileName))-4:strpos(strrev($fileName),$delimiter)-4
                                )
                    );*/
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
   
    /*
    * Arroja la imagen loading
    */
   public static function UrlLoadingImage(){
       $alias=yii::getAlias('@frontend/web/img/loading.gif');       
       return self::normalizePath(\yii\helpers\Url::base().'/img/loading.gif',DIRECTORY_SEPARATOR);
       
   }
   
    public static function UrlEmptyFile(){
       $alias=yii::getAlias('@frontend/web/img/nofile.png');
       if(!is_file($alias))
       throw new \yii\base\Exception(Yii::t('base.errors', 'The  file {archivo} doesn\'t exists ',['archivo'=>$alias])); 
       return self::normalizePath(\yii\helpers\Url::base().'/img/nofile.png',DIRECTORY_SEPARATOR);
       
   }
   
   
   public static function UrlSomeFile(){
       $alias=yii::getAlias('@frontend/web/img/somefile.png');
       if(!is_file($alias))
       throw new \yii\base\Exception(Yii::t('base.errors', 'The  file {archivo} doesn\'t exists ',['archivo'=>$alias])); 
       return self::normalizePath(\yii\helpers\Url::base().'/img/somefile.png',DIRECTORY_SEPARATOR);
       
   }
   
   
   /*
    * Checka si una uirl a un archivo funciona o esta roto el link
    */
   public static function checkUrlFound($urlAbsolute){
       $file = $urlAbsolute;     
       
        $file_headers = @get_headers($file);
        
        //var_dump($file_headers );
            if(!$file_headers || strpos($file_headers[0],'200')===false/*$file_headers[0] == static::NOT_FOUND_MESSAGE*/) {
                $exists = false;
                }
                    else {
                $exists = true;
            }
         return true;
   }
   
   /*
    * FORMTEA BYTES EN OTRAS UNIDEDADES
    */
   function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 
   
}