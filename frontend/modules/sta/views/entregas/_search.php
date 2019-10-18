<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\EntregasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entregas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codfac') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'fechacorte') ?>

    <?= $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'codperiodo') ?>

    <?php // echo $form->field($model, 'codalu') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sta.labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sta.labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
