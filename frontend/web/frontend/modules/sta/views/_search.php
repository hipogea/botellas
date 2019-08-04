<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\AulasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aulas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codaula') ?>

    <?= $form->field($model, 'codfac') ?>

    <?= $form->field($model, 'pabellon') ?>

    <?= $form->field($model, 'cap') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base.names', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
