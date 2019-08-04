<?php
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
USE yii\jui\DatePicker;
use common\widgets\ActiveFormAdvanced;
use kartik\widgets\ActiveForm as KartikForm;
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
    <br>
   
  <div class="box-body"> 
      
    
 <?php  $form = KartikForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
      
     <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            
         <?= $form->field($model,'codigo', [
                                    'addon' => ['prepend' => 
                                        ['content'=>'<i class="fa fa-key"></i>']]
                                            ]);  ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
        </div>
     </div>    
         <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= \common\widgets\imagewidget\ImageWidget::widget(['name'=>'imagenrep','model'=>$model]); ?>
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
        
         <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <?= $form->field($model, 'espadre')->checkbox() ?>
        </div>
     </div>   
      
    
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php KartikForm::end(); ?>
   
    <?php $rutita=yii::$app->urlManager->createUrl(['trabajadores/updatedialog','id'=>'7003']);   ?>
  
   

</div>
