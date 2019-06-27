<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\config\Configuracion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuracion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codcen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codocu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codparam')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('control.errors', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
