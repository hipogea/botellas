<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\selectwidget\selectWidget;
use frontend\modules\sigi\helpers\comboHelper;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiUnidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-unidades-form">

    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.Yii::t('sigi.labels', 'Grabar'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
    
 
  <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">    
 <?= $form->field($model, 'codtipo')->
            dropDownList(comboHelper::getCboTipoUnidades(),
                  ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>
          
 <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">    
 <?= $form->field($model, 'codpro')->
            dropDownList(comboHelper::getCboApoderados($model->id),
                  ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div> 
          
     
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
     <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

 </div>     
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <?= $form->field($model, 'npiso')->textInput() ?>

 </div>
 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>
  </DIV>
  <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">    
       <?= $form->field($model, 'edificio_id')->
            dropDownList(comboHelper::getCboEdificios(),
                  ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div> 
        <?php if($model->isNewRecord) { ?>
 <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'parent_id')->textInput() ?>

 </div>
 <?php } ?>
 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <?= $form->field($model, 'estreno')->textInput(['maxlength' => true]) ?>

 </div>
  
  
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalles')->textarea(['rows' => 6]) ?>

 </div>

     
    <?php ActiveForm::end(); ?>

</div>
    </div>
