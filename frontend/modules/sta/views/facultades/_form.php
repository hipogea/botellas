<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Facultades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facultades-form">
    <BR>
    <?php $form = ActiveForm::begin(); ?>

 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'codfac')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'desfac')->textInput(['maxlength' => true]) ?>

 </div>  
 <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
