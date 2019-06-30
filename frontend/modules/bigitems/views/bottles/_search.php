<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\DocbotellasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docbotellas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codestado') ?>

    <?= $form->field($model, 'codpro') ?>

    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'codcen') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'codenvio') ?>

    <?php // echo $form->field($model, 'fecdocu') ?>

    <?php // echo $form->field($model, 'fectran') ?>

    <?php // echo $form->field($model, 'codtra') ?>

    <?php // echo $form->field($model, 'codven') ?>

    <?php // echo $form->field($model, 'codplaca') ?>

    <?php // echo $form->field($model, 'ptopartida_id') ?>

    <?php // echo $form->field($model, 'ptollegada_id') ?>

    <?php // echo $form->field($model, 'comentario') ?>

    <?php // echo $form->field($model, 'essalida') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('bigitems.errors', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('bigitems.errors', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
