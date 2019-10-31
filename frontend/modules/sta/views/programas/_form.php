<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\sta\widgets\cbofacultades\cbofacultades;
use frontend\modules\sta\widgets\cboperiodos\cboperiodos;
use common\widgets\selectwidget\selectWidget;
use common\helpers\h;
 use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borereuccess">
   
    <?php $form = ActiveForm::begin(['id'=>'form-programa',
        'fieldClass'=>'\common\components\MyActiveField']); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span>".Yii::t('sta.labels', 'Guardar'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="alert alert-warning"><?=yii::t('sta.messages','Quedan {cantidad} Alumnos sin tutor asignado',['cantidad'=>$model->countStudentsFree()])?>
     
         </div>     
        </div>     
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <?= $form->field($model, 'numero')->textInput(['disabled' => 'disabled','maxlength' => true]) ?>

  </div>
 <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
      <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= cbofacultades::widget(['model'=>$model,'attribute'=>'codfac', 'form'=>$form]) ?>
  </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?=cboperiodos::widget(['model'=>$model,'attribute'=>'codperiodo', 'form'=>$form]) ?>
  </div>     
          
          
          
         

  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"> 
     <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codtra',
         'ordenCampo'=>2,
         'addCampos'=>[3,4,5],
        ]);  ?>

 </div> 
 <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"> 
     <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codtra_psico',
         'ordenCampo'=>2,
         'addCampos'=>[3,4,5],
        ]);  ?>

 </div> 
   <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
      <?= $form->field($model, 'fopen')->widget(DatePicker::class, [
                            'language' => h::app()->language,
                           'pluginOptions'=>[
                                       'format' => h::getFormatShowDate(),
                                   'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>'2010:'.date('Y'),
                               ],
                          
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>

 </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'fclose')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'tolerancia')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'duracioncita')->textInput(['maxlength' => true]) ?>

 </div>
  
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'electivo')->textInput(['maxlength' => true]) ?>

 </div>
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalles')->textarea() ?>

 </div>
    <?php ActiveForm::end(); ?>

</div>
    </div>
