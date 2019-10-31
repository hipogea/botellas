<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\widgets\selectwidget\selectWidget;
use common\helpers\h;
 use kartik\date\DatePicker;
?>

<div class="box box-success">
    <br>
    <?php $form = ActiveForm::begin([
        'id'=>'myformulario'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton(Yii::t('sta.labels', 'Grabar'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
  
 

  <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12"> 
     <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codtra',
         'ordenCampo'=>2,
         'addCampos'=>[3,4,5],
        'inputOptions'=>['enableAjaxValidation'=>true],
        ]);  ?>

 </div> 
 
<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
    
      <?= $form->field($model, 'nalumnos',['enableAjaxValidation'=>true])->textInput(['maxlength' => 3]) ?>

  </div>
   <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12"> 
      <?= $form->field($model, 'fregistro')->widget(DatePicker::class, [
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
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-info">
      <?=yii::t('sta.labels','Cantidad de alumnos libres : {alumnos}',['alumnos'=>$cantidadLibres])?>

  </div> 

    <?php ActiveForm::end(); ?>

</div>
    </div>
