<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\h;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Contactos */
/* @var $form yii\widgets\ActiveForm */
// url: '".Url::toRoute('/masters/contactos/datos')."',
?>
<?php $this->registerJs("$(document).ready(function() {
    $('.probandoSelect2').select2( 
    {
  ajax: { 
  url: '".Url::toRoute('/masters/contactos/datos')."',
   type: 'post',
   dataType: 'json',
   delay: 250,
 data: function (params) {
      var query = {
        searchTerm: params.term,
        model: 'Clipro',
        firstField: 'codpro',
        secondField: 'despro',
        thirdField:'',
      }

      // Query parameters will be ?search=[term]&type=public
      return query;
    },
   processResults: function (response) {
     return {
        results: response
     };
   },
   cache: true
  }
 }

);
     
    
});",yii\web\View::POS_END) ?>
<div class="contactos-form">

    <?php  
   // PRINT_r($aditionalParams);DIE();
    $form = ActiveForm::begin(['action'=>h::request()->url]); ?>
    <?= $form->errorSummary($model,['errorOptions' => ['encode' => false,'class' => 'help-block']]); ?>
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
   <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
  </div><div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'moviles')->textInput(['maxlength' => true]) ?>
 </div><div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>
 </div><div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'mail1')->textInput(['maxlength' => true]) ?>
 </div>
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <?php if(!h::request()->isAjax){
          
          //var_dump($vendorsForCombo);die();
          ?>
       <?= $form->field($model, 'codpro')->
            dropDownList(['370004'=>'JORGE ARMENDARIZ'],
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Company')."--",
                     'class'=>'probandoSelect2',
                        ]
                    ) ?>
      <?php } else{ ?>
         <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
           <?=$form->field($model, 'codpro')
                   ->hiddenInput(['value' => $id])
                    ->label(false)?>
       </div> 
          
     <?php } ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'fenac')->textInput(['maxlength' => true]) ?>
 </div>

        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    
    <?php ActiveForm::end(); ?>
     <?php 
   echo \yii\helpers\Html::a('pinchar', \yii\helpers\Url::toRoute(['/masters/clipro/createcontact','id'=>'370003',  'final'=>'si']), []);
  // $this->registerJs("$('#btn_prueba').on('click', function (ev) { $.pjax({container:'grilla-contactos'}); });",View::POS_HEAD); 
   //$this->registerJs("$('#btn_prueba').on('click',  alert('caramba'))",View::POS_READY); 
  // echo Html::button('Press me!', ['onClick' => "$('#mibotonmodal').click();"]) ;
   ?> 
</div>
