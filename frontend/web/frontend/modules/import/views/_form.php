<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\ImportCargamasiva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="import-cargamasiva-form">

    <?php $form = ActiveForm::begin(); ?>

 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'user_id')->textInput() ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'insercion')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'escenario')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'lastimport')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'format')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'modelo')->textInput(['maxlength' => true]) ?>

 </div>     <div class="form-group">
        <?= Html::submitButton(Yii::t('import.labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
