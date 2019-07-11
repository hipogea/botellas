<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Facultades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facultades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codfac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desfac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code3')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sta.labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
