<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
class h {
     const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';

    public static function convert($dateStr, $type='date', $format = null) {
        if ($type === 'datetime') {
              $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        }
        elseif ($type === 'time') {
              $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        }
        else {
              $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
    }
    
    public static function  app(){
        return yii::$app;
    }
    
    
    
    public static function  db(){
        return yii::$app->db;
    }
    
    public static function  session(){
        return yii::$app->session;
    }
    
    public static function  user(){
        
       // var_dump(yii::$app->user);die();
        return yii::$app->user;
    }
    
    public static function  userId(){
        return yii::$app->user->identity->id;
    }
    public static function  userName(){
        //var_dump(yii::$app->user->isGuest);die();
        return yii::$app->user->identity->username;
    }
    public static function urlManager(){
        return yii::$app->urlManager;
    }
    public static function mailer(){
        return yii::$app->mailer;
    }
    
    public static function UserIsGuest(){
        return yii::$app->user->isGuest;
    }
    
    public static function request(){
        return yii::$app->request;
    }
    
    public static function response(){
        return yii::$app->response;
    }
    
    public static function settings(){
        return yii::$app->settings;
    }
    
    public static function UserLongName(){
        return yii::$app->user->getProfile()->names;
    }
    
    public static function getImageUser($class='user-image'){
        return Html::img('@web/img/anonimo.svg', ['class'=>$class,'alt' => 'User','width'=>40,'height'=>30]);
    }
    
    public static function getCurrencies(){
        return ['PEN'=>yii::t('base.names','NEW PERUVIAN SUN'),'USD'=>yii::t('base.names','AMERICAN DOLAR')];
    }
    
    public static function getFormatShowDate(){
      return h::settings()->get('timeUser','date');
    }
    
    
    public static function getCurrenciesNames(){
        return array_keys(static::getCurrencies());
    }
    public static function paramGen($codparam,$codcen,$codocu){
        return yii::$app->paramsGen->getP($codparam,$codcen,$codocu);

    }
    
    
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
    
   public static function getDimensions(){
       return [
             'E'=> yii::t('base.names','Escalar/Units'),
           'L'=> yii::t('base.names','Lenght'),
           'M'=> yii::t('base.names','Mass'),
           'T'=> yii::t('base.names','Time'),          
            'V'=> yii::t('base.names','Volume'),
           
       ];
   } 
   
   
   
}