<?php
namespace common\actions;
use common\helpers\h;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionGetDataFromModel extends \yii\base\Action
{
	/**
	 * @var string name of the model class.
	 */
	public $modelName;
	/**
	 * @var string name of the method of model class that returns data.
	 */
	public $methodName;
	/**
	 * @var integer maximum number of rows to be returned
	 */
	public $limit=20;
	/**
	 * Suggests models based on the current user input.
	 */
	public function run()
	{
		/*
  * Esta funcion es la que buscara 
  * valores en modelos  relacionados 
  * para el url del widget common\widgets\searchwidget\SearchWidget 
  * 
  */

     if(h::request()->isAjax && h::request()->isPost ){
        $modeloName= str_replace('_','\\',h::request()->post('modeloname'));
        $valorClave=h::request()->post('valorclave');
         $campoClave=h::request()->post('campoclave');
        // var_dump($modeloName,$campoClave,$valorClave);die();         
             $modelo=$modeloName::find()->where(['=',$campoClave,$valorClave])->one();
         
         if($modelo===null)
         {
             $modelo=new $modeloName;
         }
        
        $resultados=$modelo->getAttributes();
        unset($modelo);
         echo  \yii\helpers\Json::encode([
                 'row'=>$resultados
                 ]); 
           }

	}
	/**
	 * @return CActiveRecord
	 */
	protected function getModel()
	{
	  // ECHO $TREY;
		return CActiveRecord::model($this->modelName);
	}
}