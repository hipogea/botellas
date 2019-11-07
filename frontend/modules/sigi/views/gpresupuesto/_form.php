<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\h;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiGrupoPresupuesto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-grupo-presupuesto-form">
    <br>
    <?php $form = ActiveForm::begin([
       'id'=>'form-grupo-pres',
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
          <?php 
          if(h::request()->isAjax){
               echo \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-grupo-pres',
                      //'url'=>'',
                      'url'=> \yii\helpers\Url::to(['/sigi/gpresupuesto/create']),
                     'idGrilla'=>$gridName, 
                      ]
                  ) ;
          }else{
            echo Html::submitButton(Yii::t('sigi.labels', 'Save'), ['class' => 'btn btn-success']);
            
          }
         
          ?>  
      
            

            </div>
        </div>
    </div>
      <div class="box-body">
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= 
            $form->field($model, 'tipo')->
            dropDownList($model->comboDataField('tipo') ,
                    ['prompt'=>'--'.yii::t('base.verbs','Escoja un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
</div>
 <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalle')->textarea(['rows' => 6]) ?>

 </div>
           
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
