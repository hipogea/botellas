<?php
namespace common\actions;
use common\helpers\h;
use common\helpers\ComboHelper;
USE yii\helpers\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionCombodependiente extends \yii\base\Action
{	
	public function run(){
	//Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           
            /*$modelo= h::request()->post('clase');*/
            $valorfiltro=h::request()->post('filtro');
            /*$campoclave=h::request()->post('campoclave');
            $camporef=h::request()->post('camporef');*/
           $isremote=h::request()->post('isremotesource');
           $source=h::request()->post('source');
           if($isremote=='yes'){
               
             $modelo=array_keys($source)[0];
            //var_dump($source);die();
             //$valorfiltro='20';
             $datos=ComboHelper::getCboGeneral(
                     $valorfiltro,
                     $modelo,
                     $source[$modelo]['campofiltro'],
                     $source[$modelo]['campoclave'],
                      $source[$modelo]['camporef']);
             //print_r($datos);die();
             
           }else{/*Se traa de datos directametne */
               $datos=$source;
             
           }
          return $this->generateHtml($datos);   
        }
        
        private function generateHtml($datos){
           return  Html::renderSelectOptions('', $datos);
        }
}