<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\CentrosparametrosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centrosparametros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codparam') ?>

    <?= $form->field($model, 'codcen') ?>

    <?= $form->field($model, 'valor') ?>

    <?= $form->field($model, 'valor1') ?>

    <?php // echo $form->field($model, 'valor2') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
