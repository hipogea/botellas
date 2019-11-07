<?php
/*
 * Esta clase extiende la clase original
 * pero adicionalmetne devuelve los data
 * para los combos  
 * FACULTADES
 * CARRERAS
 * CARRERAS POR FACULTAD
 */
namespace frontend\modules\sigi\helpers;
use common\helpers\ComboHelper as Combito;
use yii\helpers\ArrayHelper;
class comboHelper extends Combito
{
     public static function getCboEdificios(){
        return ArrayHelper::map(
                        \frontend\modules\sigi\models\Edificios::find()->all(),
                'id','nombre');
    }
    
    public static function getCboTipoUnidades(){
        return ArrayHelper::map(
        \frontend\modules\sigi\models\SigiTipoUnidades::find()->all(),
                'codtipo','desunidad');
    }
    
      public static function getCboCargos(){
        return ArrayHelper::map(
        \frontend\modules\sigi\models\SigiCargos::find()->all(),
                'id','descargo');
    }
    
    public static function getCboGrPresup(){
        return ArrayHelper::map(
        \frontend\modules\sigi\models\SigiGrupoPresupuesto::find()->all(),
                'codigo','descripcion');
    }
    
    /*
     * Devuel combno apoderados  por edificio
     */
    public static function getCboApoderados($id_edificio){
        $apode= \frontend\modules\sigi\models\SigiApoderados::find()
                 ->select(['codpro'])
                 ->where(['edificio_id'=>$id_edificio])->asArray()->all();
 $codigos=ArrayHelper::getColumn($apode, 'codpro');
        return ArrayHelper::map(
                \common\models\masters\Clipro::find()->
                where(['in',
              'codpro', $codigos
               ])->all(),
                'codpro','despro');
        
    }
    
     public static function getCboSameUnits($id_edificio,$id=null){
      if($id===null){
          return ArrayHelper::map(
                          \frontend\modules\sigi\models\SigiUnidades::find()
                  ->where(['edificio_id'=>$id_edificio])->all(),
                'id','numero'); 
      }else{
          return ArrayHelper::map(
                          \frontend\modules\sigi\models\SigiUnidades::find()
                  ->where(['edificio_id'=>$id_edificio])
                  ->andWhere(['not', 'id=1'])->all(),
                'id','numero'); 
      }
       
    }
}


