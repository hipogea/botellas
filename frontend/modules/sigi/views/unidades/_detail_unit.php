<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use common\helpers\ComboHelper;
use common\widgets\selectwidget\selectWidget;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\Edificios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="edificios-form">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      
      <div class="box-body">
    
 
 
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
     <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

 </div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
     <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
     <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>
 </div>        
          
     
      
          
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
