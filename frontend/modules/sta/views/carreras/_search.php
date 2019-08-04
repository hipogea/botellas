<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\CarrerasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carreras-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'codcar') ?>

    <?= $form->field($model, 'codfac') ?>

    <?= $form->field($model, 'descar') ?>

    <?= $form->field($model, 'code1') ?>

    <?= $form->field($model, 'code2') ?>

    <?php // echo $form->field($model, 'code3') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base.names', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
