<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiGrupoPresupuestoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-grupo-presupuesto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'detalle') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sigi.labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sigi.labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
