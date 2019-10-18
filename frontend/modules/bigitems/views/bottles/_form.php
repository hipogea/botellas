<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\selectwidget\selectWidget;
use common\helpers\ComboHelper;
use common\helpers\h;
 use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\Docbotellas */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<div class="docbotellas-form">

    <?php $form =\yii\bootstrap\ActiveForm::begin([
    'enableAjaxValidation'=> true,'id'=>'tabular-botellas'
  
]); ?>
    <div class="box-footer">
        
    <div class="col-md-12">
      <div class="form-group no-margin">
        <?= Html::submitButton(Yii::t('bigitems.errors', 'Save'), ['class' => 'btn btn-success']) ?>
          <?= Html::submitButton(Yii::t('bigitems.errors', 'Save'), ['class' => 'btn btn-success']) ?>
      </div>         
      

      </div>
    </div>  
    
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
             'addCampos'=>[2,3],
            //'foreignskeys'=>[1,2,3],
        ]);  ?>
    </div>
    
     
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    
    <?= $form->field($model, 'codenvio')->
            dropDownList(
                    comboHelper::getCboValores($model->RawTableName().'.codenvio'),                    
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      'disabled'=>($model->isBlockedField('codenvio'))?'disabled':null,
                        ]
                    ) ?>
       
</div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
      <?= $form->field($model, 'fecdocu')->widget(DatePicker::class, [
                            'language' => h::app()->language,
                           'pluginOptions'=>[
                                       'format' => h::getFormatShowDate(),
                                   'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>'1980:'.date('Y'),
                               ],
                          
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
    <?= $form->field($model, 'fectran')->widget(DatePicker::class, [
                            'language' => h::app()->language,
                           'pluginOptions'=>[
                                       'format' => h::getFormatShowDate(),
                                   'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>'1980:'.date('Y'),
                               ],
                          
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?> <?php /*h::settings()->invalidateCache();echo h::getFormatShowDate() */ ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?php 
    //$model->fillRelations();
    //print_r($model->_obRelations);die();
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codtra',
        'ordenCampo'=>2,
         'addCampos'=>[3,4,5],
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
            'campo'=>'codven',
        'ordenCampo'=>2
            //'foreignskeys'=>[1,2,3],
        ]);  ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'codplaca')->textInput(['maxlength' => true]) ?>

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

 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?php // echo $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

 </div> 
 
 
 

   



  



 <?php  
 //var_dump($this->context);die();
 echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => yii::t('base.names','Items'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('detalle_1',[ 'form' => $form, 'items' => $items]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => true
        ],
       
    ],
]);  
    
    ?> 


   <?php \yii\bootstrap\ActiveForm::end(); ?>  
 
</div>