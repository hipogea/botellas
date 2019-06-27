<?php
namespace common\actions;
use common\helpers\h;
use yii\helpers\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionGetDataFromModal extends \yii\base\Action
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
        $this->controller->layout="install";
      
     
        //$prefix=h::request()->get('prefix');
       // $divid=h::request()->get('divid');
      $flag=h::request()->get('cierra');
      $nombrecontrol=h::request()->get('nombrecontrol');
      $valor=h::request()->get('valor');
      $campoclave=h::request()->get('nombrecampoforaneo');
     // var_dump($campoClave);die();
      if(!is_null($flag)){
         echo  Html::script(" "
                 . "window.parent.$('#modal-".$nombrecontrol."').dialog('close');"
                ." window.parent.$('#".$nombrecontrol."').val('".$valor."').trigger('change');"                
                 . "");
         die();
      }
        
       // $nombredialog=h::request()->get('nombredialog');
         $nombremodelo=str_replace('_','\\',h::request()->get('nombremodelo')).'Search';
         
            $searchModel = new $nombremodelo();
            $camposAdicionales= $searchModel->attributes;
            unset($camposAdicionales[$campoclave]);
            $camposAdicionales=array_keys($camposAdicionales);
            $dataProvider = $searchModel->search(h::request()->queryParams);
             return $this->controller->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
             'nombrecontrol'=> $nombrecontrol,
              'campoclave'=>$campoclave,
                 'camposAdicionales'=>$camposAdicionales,
        //'nombredialog'=>  $nombredialog  ,  
             
        ]); 
       
       
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