<?php
use common\helpers\ComboHelper;
?>

<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'codocu')->textInput(['maxlength' => true]) ?>
 </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'desdocu')->textInput(['maxlength' => true]) ?>
</div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
   
    <?= $form->field($model, 'clase')->textInput(['maxlength' => true,]) ?>
</div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
   
    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>
</div>
     
   
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'tabla')->
            dropDownList(ComboHelper::getCboModels(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Model')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>

      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
   
    <?= $form->field($model, 'abreviatura')->textInput(['maxlength' => true]) ?>
</div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
   
    <?= $form->field($model, 'prefijo')->textInput(['maxlength' => true]) ?>
</div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
   
    <?= $form->field($model, 'escomprobante')->checkbox(); ?>
</div>
