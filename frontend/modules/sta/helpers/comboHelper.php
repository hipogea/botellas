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
}


