<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use frontend\modules\sigi\helpers\comboHelper;
use common\helpers\timeHelper;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiBasePresupuesto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-base-presupuesto-form">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton(Yii::t('sigi.labels', 'Save'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
   <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

 </div> 

 <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= 
            $form->field($model, 'edificio_id')->
            dropDownList(comboHelper::getCboEdificios() ,
                    ['prompt'=>'--'.yii::t('base.verbs','Escoja un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
</div>
 <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
  <div class="input-group">
<?php Pjax::begin(['id'=>'combito-grupo']); ?>
          <?= 
            $form->field($model, 'codgrupo')->
            dropDownList(comboHelper::getCboGrPresup() ,
                    ['prompt'=>'--'.yii::t('base.verbs','Escoja un valor')."--",
                    // 'class'=>'input-group',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
 <?php Pjax::end(); ?>
        
  <div class="input-group-btn">
         <?php 
    $url= Url::to(['gpresupuesto/create','id'=>$model->id,'gridName'=>'combito-grupo','idModal'=>'buscarvalor']);
    echo  Html::button(yii::t('sigi.labels','+'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Grupo'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 

    ?>
    
   </div> 
      </div>  
</DIV>
 
  
  
   <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

 </div>
 
   <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= 
            $form->field($model, 'ejercicio')->
            dropDownList(timeHelper::cboAnnos() ,
                    ['prompt'=>'--'.yii::t('base.verbs','Escoja un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
</div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'mensual')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'anual')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'restringir')->checkbox([]) ?>

 </div>
           <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'activo')->checkbox([]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'acumulado')->textInput(['maxlength' => true]) ?>

 </div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalles')->textarea(['rows' => 6]) ?>

 </div>
           
    <?php ActiveForm::end(); ?>

</div>
    </div>
