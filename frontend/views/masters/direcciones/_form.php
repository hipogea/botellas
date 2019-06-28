<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Direcciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="direcciones-form">

    <?php $form = ActiveForm::begin(); ?>

  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'direc')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'nomlug')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'distrito')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'provincia')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'departamento')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'latitud')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'meridiano')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?php 
  // $necesi=new Parametros;
    echo \common\widgets\selectwidget\selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codpro',
            //'foreignskeys'=>[1,2,3],
        ]);  ?>
    </div>

 </div>     <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
