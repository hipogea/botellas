<?php
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
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

