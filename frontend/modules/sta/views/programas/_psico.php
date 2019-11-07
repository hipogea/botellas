<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\widgets\selectwidget\selectWidget;
use common\helpers\h;
 use kartik\date\DatePicker;
 ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
?>

<div class="box box-success">
    <br>
    
    <?php $form = ActiveForm::begin([
        'id'=>'myformulario'/*,'enableAjaxValidation'=>true*/
    ]); ?>
      <div class="box-header">
          <?= $form->errorSummary($model); ?>
        <div class="col-md-12">
            <div class="form-group no-margin">
          <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'myformulario',
                      'url'=> \yii\helpers\Url::to(['/sta/programas/agrega-psico','id'=>$id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
         <?= Html::button(Yii::t('sta.labels', 'Grabar'),['onclick'=>"psico_saves()", 'class' => 'btn btn-success']) ?>       
        
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
        'inputOptions'=>[/*'enableAjaxValidation'=>true*/],
        ]);  ?>

 </div> 
 
<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
    
      <?= $form->field($model, 'nalumnos',[/*'enableAjaxValidation'=>true*/])->textInput(['maxlength' => 3]) ?>

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
<script>
    function psico_saves(){
        var $form=$('#myformulario');
       
        $.ajax({
            url:"/frontend/web/sta/programas/agrega-psico?id=35",
            type: 'post',
            data:$form.serialize(),
            success: function(data){
               if(data.success=='1') {
                   if(data.type==1) {
                       $('#buscarvalor').modal('hide');
                       $.pjax.reload('#grilla-staff');
                    }else{
                          $('#buscarvalor').modal('hide');
                      $.pjax.reload('#grilla-staff');
                     }
               }
               if(data.success=='2') {
                   var msg=data.msg;
                   if(msg){
                       $.each(msg,function(key,val){
                           var div=$('.field-'+key);
                           div.addClass(" has-error");
                           div.find('.help-block').html(val);
                       });
                   }
               }
            }
              });
    }
</script>