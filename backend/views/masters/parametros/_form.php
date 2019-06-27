<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Parametros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parametros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codparam')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desparam')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'explicacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tipodato')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitud')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
