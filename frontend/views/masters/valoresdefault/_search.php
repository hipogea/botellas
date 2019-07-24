<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\ValoresdefaultSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="valoresdefault-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codocu') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'nombrecampo') ?>

    <?= $form->field($model, 'valor') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base.names', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
