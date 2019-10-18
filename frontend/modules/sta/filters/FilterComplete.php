<?php
namespace frontend\modules\sta\filters;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\Url;
/*
 * Este filtro se implementa para 
 * asegurarnos que un usuario no pueda acceder
 * a una facultad que no le pertenece
 * ES UNA REGLA COMPLEMENTARIA AL RBAC
 * el cual no se puede manejar a este enivel
 */
class FilterFacultades extends ActionFilter
{
    
    public function beforeAction($action)
    {
       // var_dump(yii::$app->controller->module);die();
     
    
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
       
        return parent::afterAction($action, $result);
    }
}