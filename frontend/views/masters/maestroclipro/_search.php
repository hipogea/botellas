<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\MaestrocliproSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maestroclipro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'venta') ?>

    <?= $form->field($model, 'codpro') ?>

    <?= $form->field($model, 'codart') ?>

    <?= $form->field($model, 'vencimiento') ?>

    <?php // echo $form->field($model, 'tiempoentrega') ?>

    <?php // echo $form->field($model, 'codcen') ?>

    <?php // echo $form->field($model, 'precio') ?>

    <?php // echo $form->field($model, 'codmon') ?>

    <?php // echo $form->field($model, 'param1') ?>

    <?php // echo $form->field($model, 'param2') ?>

    <?php // echo $form->field($model, 'param3') ?>

    <?php // echo $form->field($model, 'param4') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base.names', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
