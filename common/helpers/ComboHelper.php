<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir los combos
 */
namespace common\helpers;
use yii;
use yii\helpers\ArrayHelper;

class ComboHelper  {
    
    /*
     * Funciones que devuelven arrays para rellenar los combos
     * ma comunes de datos maestros 
     */
    public static function getCboMaterials(){
        return ArrayHelper::map(
                \common\models\masters\Maestrocompo::find()->all(),
                'codart','descripcion');
    }
    
    public static function getCboClipros(){
        return ArrayHelper::map(
                \common\models\masters\Clipro::find()->all(),
                'codpro','despro');
    }
    
    public static function getCboCentros(){
        return ArrayHelper::map(
                \common\models\masters\Centros::find()->all(),
                'codcen','nomcen');
    }
    
    public static function getCboTables(){
        return ArrayHelper::map(
                        \common\models\masters\ModelCombo::find()->all(),
                'parametro','parametro');
    }
    
     public static function getCboValores($tableName){
        return ArrayHelper::map(
     \common\models\masters\Combovalores::find()->where(['[[nombretabla]]'=>$tableName])->all(),
                'codigo','valor');
    }
    
     public static function getCboFavorites($iduser=null){
         $iduser=is_null($iduser)?static::userId():$iduser;        
        return ArrayHelper::map(
                        \common\models\Userfavoritos::find()->where(['[[user_id]]'=>$iduser])->all(),
                'url','alias');
    }
    
     public static function getCboDocuments($iduser=null){
         //$iduser=is_null($iduser)?static::userId():$iduser;        
        return ArrayHelper::map(
                        \common\models\masters\Documentos::find()->all(),
                'codocu','desdocu');
    }
    
   /*
    * Obtiene todos los nombres de los modelos de la aplicacion
    */
    public static function getCboModels(){
             
        return array_combine(
                        \common\helpers\FileHelper::getModels(),
                \common\helpers\FileHelper::getModels());
    }
    
     /*
    * Obtiene todos los nombres de los modelos de la aplicacion
    */
    public static function getCboRoles(){
           $roles= array_keys(yii::$app->authManager->getRoles());
        return array_combine($roles,$roles);
    }
   
    /*
     * Obtiene los valores masters de la tabla combovalores
     * @key: clave para filtrar los datos 
     * @codcentro: Opcional para filtrar un parametro que depende del centro 
     */
    public static function getTablesValues($key,$codcentro=null){
        if(is_null($codcentro))
        return ArrayHelper::map(
       \common\models\masters\Combovalores::find()->where(['[[nombretabla]]'=> strtolower($key)])->all(),
               'codigo','valor');
       return ArrayHelper::map(
       \common\models\masters\Combovalores::find()->where(
               [
                   '[[nombretabla]]'=> strtolower(trim($key)),
                   '[[codcen]]'=>trim($codcentro)
                   ])->all(),
               'codigo','valor');  
        
   }
   
   
   
    /*
    * Obtiene todos los nombres de los modelos de la aplicacion
    */
    public static function getCboUms(){
         return ArrayHelper::map(
                        \common\models\masters\Ums::find()->all(),
                'codum','desum');
    }
   
   
}