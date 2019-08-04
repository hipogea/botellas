<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\FacultadesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facultades-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codfac') ?>

    <?= $form->field($model, 'desfac') ?>

    <?= $form->field($model, 'code1') ?>

    <?= $form->field($model, 'code2') ?>

    <?= $form->field($model, 'code3') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base.names', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
