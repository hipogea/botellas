<?php
namespace backend\controllers;
use Yii;
use common\helpers\h;
use yii\web\Controller;
//use yii\helpers\Html;
/**
 * CliproController implements the CRUD actions for Clipro model.
 */
class FinderController extends  \common\controllers\base\baseController
{
  public function actions() {
      parent::actions();
      return [
           'alert'=> [
                        'class' => 'common\actions\ActionDelete',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          //'action1' => 'app\components\Action1',
             'busqueda' => [
                        'class' => 'common\actions\ActionGetDataFromModel',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          'busquedamodal' => [
                        'class' => 'common\actions\ActionGetDataFromModal',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          'searchselect' => [
                        'class' => 'common\actions\ActionSearchSelect',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ]
      ];
      
  }
 public function actionHola(){
     echo "hola ";
 }
}
