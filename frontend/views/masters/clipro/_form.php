<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;


  use common\models\masters\Clipro;
use common\models\masters\Direcciones;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */
/* @var $form yii\widgets\ActiveForm */
?>

    
<div class="box box-success">



    <?php $form = ActiveForm::begin(); ?>
    <div class="box-footer">
        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= Html::submitButton("<span class=\"fa fa-save\"></span>".($model->isNewRecord) ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
       
            
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
       
            </div>
        </div>
    </div>
    <div class="box-body">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'codpro')->textInput(['disabled'=>'disabled','maxlength' => true]) ?>
    </div>
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'rucpro')->textInput(['maxlength' => true]) ?>
      </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'despro')->textInput(['maxlength' => true]) ?>
    </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'telpro')->textInput(['maxlength' => true]) ?>
         </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>
          </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'deslarga')->textarea(['rows' => 6]) ?>
        </div>
   </div>
    
    <?php ActiveForm::end(); ?>


</div>
