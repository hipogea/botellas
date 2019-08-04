<?php
namespace common\actions;
use common\helpers\h;
use common\models\masters\Documentos;
use yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionRenderParam extends \yii\base\Action
{
	
	public function run()
	{
         
        //$clase=str_replace('_','\\',h::request()->get('nombreclase'));
        $id=h::request()->get('codocu');
        if(!is_numeric($id+0))
          throw new \yii\base\Exception(Yii::t('base.errors', 'Codocu is invalid'));
        $this->controller->layout = "install";
       
        $model = Documentos::find()->where(['codocu'=>$id])->one();
        
        if (h::request()->isPost && $model->save()) {
           // h::request()->get('idModal');die();
            //echo \yii\helpers\Html::script("$('#createCompany').modal('hide'); window.parent.$.pjax({container: '#grilla-contactos'})");
            //$this->controller->closeModal('buscarvalor');
        
        } else {
           
            return $this->controller->render('/comunes/parametros', [
                        'model' => $model,
                        'dataProvider'=>$model->providerParam(),
                        //'vendorsForCombo' => $vendorsForCombo,
            ]);
        }

        /* $type = $request['type'];
          $category_selector = false;
          if (request()->has('category_selector')) {
          $category_selector = request()->get('category_selector');
          }
          $rand = rand(); */



        /* $modelclipro=$this->findModel($id);
          $model = new Contactos();
          $html = $this->render('modal_contactos',
          ['model'=>$model,
          'aleatorio'=>rand(),
          'titulo'=>'hola amigos']);
          return json_encode([
          'success' => true,
          'error' => false,
          'message' => 'null',
          'html' => $html,
          ]);
          }
         */   
          
             }
}