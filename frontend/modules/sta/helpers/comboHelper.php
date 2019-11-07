<?php
/*
 * Esta clase extiende la clase original
 * pero adicionalmetne devuelve los data
 * para los combos  
 * FACULTADES
 * CARRERAS
 * CARRERAS POR FACULTAD
 */
namespace frontend\modules\sta\helpers;
use common\helpers\ComboHelper as Combito;
use yii\helpers\ArrayHelper;
class comboHelper extends Combito
{
     public static function getCboFacultades(){
        return ArrayHelper::map(
                        \frontend\modules\sta\models\Facultades::find()->all(),
                'codfac','desfac');
    }
    
    public static function getCboPeriodos(){
        return ArrayHelper::map(
                        \frontend\modules\sta\models\Periodos::find()->all(),
                'codperiodo','periodo');
    }
    
    public static function getCboCarreras(){
        return ArrayHelper::map(
                \frontend\modules\sta\models\Facultades::find()->all(),
                'codcar','descar');
    }
    
    public static function getCboCarrerasByFac($codfac){
        return ArrayHelper::map(
                \frontend\modules\sta\models\Facultades::find()->
                where(['codfac'=>$codfac])->all(),
                'codcar','descar');
    }
    /*
     * Dvel todos los piscologos dentro de una programa
     */
     public static function getCboTutoresByProg($id){
         $psicologos= \frontend\modules\sta\models\Tallerpsico::find()
                 ->select(['codtra'])
                 ->where(['talleres_id'=>$id])->asArray()->all();
 $codigos=ArrayHelper::getColumn($psicologos, 'codtra');
        return ArrayHelper::map(
                \common\models\masters\Trabajadores::find()->
                where(['in',
              'codigotra', $codigos
               ])->all(),
                'codigotra','ap');
    }
    
    /*
     * Devuelve todos los testPiscologicos
     */
     public static function getCboTests($idprograma=null){
         
       if($idprograma===null){
           return ArrayHelper::map(
           \frontend\modules\sta\models\Test::find()->all(),
                'codtest','descripcion');
       }else{
           /*return ArrayHelper::map(
           \frontend\modules\sta\models\Test::find()->
                where([])->   
                   all(),
                'codtest','descripcion'); */
       }
         
        }

}


