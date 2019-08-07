<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\masters\Centros */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="install-loading"></div>
<div class="centros-form">

   <?php $form = ActiveForm::begin([
'id' => 'centros-form',
'enableAjaxValidation' => true,
]); ?>

    <?= $form->field($model, 'codcen')->textInput([ 'enableAjaxValidation' => true,'maxlength' => true]) ?>

    <?= $form->field($model, 'nomcen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codsoc')->textInput(['enableAjaxValidation' => true,'maxlength' => true]) ?>

    <?= $form->field($model, 'descricen')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['id'=>'MY-button','class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
     <?php if(!$model->isNewRecord)echo $this->render('_details',[
        'searchModel' => $searchModel,
         'dataProvider' => $dataProvider,]); ?>
    
</div>
    
<script type="text/javascript">                   
       $('#MY-button').on('click', function() {
       $('#install-loading').html('<span class="install-loading-bar" style="height:300px;"><span class="install-loading-spin"><i class="fa fa-spinner fa-spin"></i></span></span>');
                          });
      $('.install-loading-bar').css({"height": $('#centros-form').height() - 12});
                </script>