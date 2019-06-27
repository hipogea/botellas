<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sociedades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sociedades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'socio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dsocio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rucsoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccionfiscal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefonos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'regimentributario')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('control.errors', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
