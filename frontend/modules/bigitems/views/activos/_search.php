<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\ActivosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'codigo2') ?>

    <?= $form->field($model, 'codigo3') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'marca') ?>

    <?php // echo $form->field($model, 'modelo') ?>

    <?php // echo $form->field($model, 'serie') ?>

    <?php // echo $form->field($model, 'anofabricacion') ?>

    <?php // echo $form->field($model, 'codigoitem') ?>

    <?php // echo $form->field($model, 'codigocontable') ?>

    <?php // echo $form->field($model, 'espadre') ?>

    <?php // echo $form->field($model, 'lugar_original_id') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'codarea') ?>

    <?php // echo $form->field($model, 'codestado') ?>

    <?php // echo $form->field($model, 'lugar_id') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'codocu') ?>

    <?php // echo $form->field($model, 'numdoc') ?>

    <?php // echo $form->field($model, 'entransporte') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
