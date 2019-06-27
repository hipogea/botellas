<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SociedadesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sociedades-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'socio') ?>

    <?= $form->field($model, 'dsocio') ?>

    <?= $form->field($model, 'rucsoc') ?>

    <?= $form->field($model, 'activo') ?>

    <?= $form->field($model, 'direccionfiscal') ?>

    <?php // echo $form->field($model, 'telefonos') ?>

    <?php // echo $form->field($model, 'web') ?>

    <?php // echo $form->field($model, 'mail') ?>

    <?php // echo $form->field($model, 'regimentributario') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('control.errors', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('control.errors', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
