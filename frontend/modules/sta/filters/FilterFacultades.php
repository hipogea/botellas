<?php
namespace frontend\modules\sta\filters;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\Url;
/*
 * Este filtro se implementa para 
 * asegurarnos que todo usuario que usa este módulo
 * tenga un perfil Interlocutor asignado;  de otro modo
 * no tendrá acceso a ninguna función
 */
class FilterComplete extends ActionFilter
{
    
    public function beforeAction($action)
    {
       // var_dump(yii::$app->controller->module);die();
      if(!yii::$app->controller->module->hasInterlocutor() )
      return  yii::$app->controller->redirect(Url::toRoute('default/complete'));
    
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
       
        return parent::afterAction($action, $result);
    }
}