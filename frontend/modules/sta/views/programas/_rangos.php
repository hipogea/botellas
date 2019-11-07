<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\h;
use kartik\widgets\TimePicker;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borereuccess">
   
    <?php $form = ActiveForm::begin(['id'=>'form-rango',
        'fieldClass'=>'\common\components\MyActiveField']); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
            <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-rango',
                      'url'=> \yii\helpers\Url::to(['/sta/programas/edit-rango','id'=>$id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
            </div>
        </div>
    </div>
      <div class="box-body">
       
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <?PHP
     echo $form->field($model, 'hinicio')->widget(TimePicker::classname(), [
         'pluginOptions'=>[
             'showSeconds'=>false,
             'showMeridian'=>false
             ]
     ]);
      ?>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <?PHP
     echo $form->field($model, 'hfin')->widget(TimePicker::classname(), [
         'pluginOptions'=>[
             'showSeconds'=>false,
             'showMeridian'=>false
             ]
     ]);
      ?>
  </div>
 <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
      <?= $form->field($model, 'activo')->checkbox([]) ?>

  </div>
  
 </div>
    <?php ActiveForm::end(); ?>

</div>
    </div>
