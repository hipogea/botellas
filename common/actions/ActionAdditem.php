<?php
namespace common\actions;
use common\helpers\h;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionAdditem extends \yii\base\Action
{
	
	public function run()
	{
	if(h::request()->isAjax){
            $form= unserialize(h::request()->post('form'));
            $model= unserialize(h::request()->post('form'));
          $filter= h::request()->post('searchTerm');
         $modelo= h::request()->post('model');
         // VAR_DUMP($modelo);
         $firstField=h::request()->post('firstField');
         $secondField=h::request()->post('secondField');
         $modelo=str_replace('_','\\',$modelo);
         if(is_null($filter) or empty($filter) or trim($filter)=="") 
              $resultados=[];
           else{
               //VAR_DUMP($modelo);die();
             $resultados= $modelo::find()->select([$firstField." as id",$secondField.' as text'])->where(['like',$secondField,$filter])->asArray()->all();
         
            
         }
         
           echo  \yii\helpers\Json::encode($resultados);
           //ECHO \yii\helpers\Json::encode([['id'=>'001','text'=>'PRIMERO'],['id'=>'002','text'=>'SEGUNDO']]);
        }
          }
}