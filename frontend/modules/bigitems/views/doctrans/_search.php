<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\GuiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'numgui') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'serie') ?>

    <?= $form->field($model, 'codpro') ?>

    <?php // echo $form->field($model, 'codpro_tran') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'fecha_tran') ?>

    <?php // echo $form->field($model, 'codestado') ?>

    <?php // echo $form->field($model, 'chofer') ?>

    <?php // echo $form->field($model, 'codmotivo') ?>

    <?php // echo $form->field($model, 'placa') ?>

    <?php // echo $form->field($model, 'confvehicular') ?>

    <?php // echo $form->field($model, 'brevete') ?>

    <?php // echo $form->field($model, 'ptopartida_id') ?>

    <?php // echo $form->field($model, 'ptollegada_id') ?>

    <?php // echo $form->field($model, 'codcen') ?>

    <?php // echo $form->field($model, 'codocu') ?>

    <?php // echo $form->field($model, 'comentario') ?>

    <?php // echo $form->field($model, 'essalida') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('bigitems.labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('bigitems.labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
