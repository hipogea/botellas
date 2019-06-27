<?php
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
USE yii\jui\DatePicker;
use common\widgets\ActiveFormAdvanced;
use common\helpers\HtmlA;
use common\models\Oficios;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
use yii\helpers\Url;
use yii\bootstrap\ButtonGroup;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\Trabajadores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">
 <?= Html::a('devolver valor', "#", ['onclick'=>'window.close();']) ?>
   
  <div class="box-body">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="name" class="control-label">Nombre</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-id-card-o"></i></div>
                        <input class="form-control" placeholder="Ingrese Nombre" required="required" name="name" type="text" id="name">
                </div>
    
        </div>
         <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="sku" class="control-label">SKU</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                        <input class="form-control" placeholder="Ingrese SKU" required="required" name="sku" type="text" id="sku">
                </div>
    
        </div>
    </div>
    
 <?php $form = ActiveFormAdvanced::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
      
     <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            
         <?= $form->field($model,'codigo', [
                                    'addon' => ['prepend' => 
                                        ['content'=>'<i class="fa-arrow-circle-up"></i>']]
                                            ]); ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
        </div>
     </div>    
        
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <?= $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <?= $form->field($model, 'modelo')->textInput(['maxlength' => true]) ?>
        </div>
     </div>   
    
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <?= $form->field($model, 'serie')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <?= $form->field($model, 'anofabricacion')->textInput(['maxlength' => true]) ?>
        </div>
     </div>   
      
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveFormAdvanced::end(); ?>
   
    <?php $rutita=yii::$app->urlManager->createUrl(['trabajadores/updatedialog','id'=>'7003']);   ?>
  
   

</div>
