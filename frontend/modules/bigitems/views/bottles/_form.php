<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\selectwidget\selectWidget;
use common\helpers\ComboHelper;
/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\Docbotellas */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<div class="docbotellas-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
  <?= $form->field($model, 'numero')->textInput(['disabled' => 'true']) ?>

 </div> 
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
   <?= $form->field($model, 'essalida')->
            dropDownList([
                '0'=>yii::t('bigitems.labels','INPUT'),
                '1'=>yii::t('bigitems.labels','OUTPUT'),
                        ] ,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      'disabled'=>($model->isBlockedField('essalida'))?'disabled':null,
                        ]
                    ) ?>

 </div>  
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
     <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
 </div> 
    
    
    

    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codpro',
            //'foreignskeys'=>[1,2,3],
        ]);  ?>
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'codcen')->textInput(['maxlength' => true]) ?>

 </div>  
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    
    <?= $form->field($model, 'codenvio')->
            dropDownList(ComboHelper::getTablesValues('docbotellas.envio') ,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      'disabled'=>($model->isBlockedField('codenvio'))?'disabled':null,
                        ]
                    ) ?>
       
</div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'fecdocu')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'fectran')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codtra',
        'ordenCampo'=>2
            //'foreignskeys'=>[1,2,3],
        ]);  ?>
 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'codven')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'codplaca')->textInput(['maxlength' => true]) ?>

 </div> 
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'ptopartida_id',
            //'foreignskeys'=>[1,2,3],
        ]);  ?>
    </div>
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
     <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'ptollegada_id',
            //'foreignskeys'=>[1,2,3],
        ]);  ?>
    </div>

 </div>  
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

 </div> 
 
 
 <div class="form-group">
        <?= Html::submitButton(Yii::t('bigitems.errors', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
