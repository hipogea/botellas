<?php
namespace common\actions;
use common\helpers\h;
use common\models\base\modelBase;
use yii\helpers\Html;
use yii\base\Exception;
use yii;
/* 
 *borr cualquier tipo de modelo
 * pero antes s efija si tinene hijos 
 */

class ActionDelete extends \yii\base\Action
{
	const NOMBRE_CLASE_PARAMETER='modelo';
    const ID_CLASE_PARAMETER='id';
    
	public $modelName;
	
	public function run()
	{
          
           
            $datos=[];
	$modelClass=unserialize(h::request()->get(static::NOMBRE_CLASE_PARAMETER));
        $id=h::request()->get(static::ID_CLASE_PARAMETER);
        $model=$modelClass::findOne($id);
        if($model instanceof modelBase && !is_null($model)){
           
                if($model->hasChilds()){
                    $datos['error']=yii::t('base.errors','The record has Childs Records ');  
                }else{
                      try{ 
                             if($model->delete()<> false){
                                 $datos['success']=yii::t('base.errors','The record was deleted successfully...!');  
                            }
                            } catch (Exception $ex) {
                             $datos['error']=yii::t('base.errors','There are some troubles by deleting this record : {mensaje} ',['mensaje'=>$ex->message]);  
                
                            }
                }
              
        }else{
          $datos['error']=yii::t('base.errors','The class : "{clase}" is not Instance of "baseModel" ',['clase'=>$modelClass]);  
                  
        }
            
       
            //$datos['success']="TODO OK";
       //$data = 'Some data to be returned in response to ajax request';
   // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return $datos;
       
        }
	
}