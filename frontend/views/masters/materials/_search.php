<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\MaestrocompoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maestrocompo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codart') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'marca') ?>

    <?= $form->field($model, 'modelo') ?>

    <?php // echo $form->field($model, 'numeroparte') ?>

    <?php // echo $form->field($model, 'codum') ?>

    <?php // echo $form->field($model, 'peso') ?>

    <?php // echo $form->field($model, 'codtipo') ?>

    <?php // echo $form->field($model, 'esrotativo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base.names', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
