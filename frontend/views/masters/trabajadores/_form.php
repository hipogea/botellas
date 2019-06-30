<?php
//use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use common\helpers\h;
use common\helpers\ComboHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">

    <?php $form = ActiveForm::begin([
    'id' => 'trabajadores-form',
    'enableAjaxValidation' => true,
    'options'=>['enctype' => 'multipart/form-data'],'fieldClass' => '\common\components\MyActiveField']); ?>
       
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'codigotra')->textInput(['disabled'=>'disabled','maxlength' => true]) ?>
  </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    
    <?= $form->field($model, 'ap')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'am')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'ppt')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'pasaporte')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codpuesto')->
            dropDownList(ComboHelper::getTablesValues('puestotrabajo') ,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'cumple')->widget(DatePicker::class, [
                             'language' => h::app()->language,
                           // 'readonly'=>true,
                          // 'inline'=>true,
                           'pluginOptions'=>[
                                     'format' => 'dd.mm.yyyy', 
                                  'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>"-99:+0",
                               ],
                           
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'fecingreso')->widget(DatePicker::class, [
                            'language' => h::app()->language,
                           'pluginOptions'=>[
                                       'format' => 'dd.mm.yyyy',
                                   'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>'1980:'.date('Y'),
                               ],
                          
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'telfijo')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'telmoviles')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>
</div>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('control.errors', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    
    
    <?= \nemmo\attachments\components\AttachmentsInput::widget([
	'id' => 'file-input', // Optional
	'model' => $model,
	'options' => [ // Options of the Kartik's FileInput widget
		'multiple' => true, // If you want to allow multiple upload, default to false
	],
	'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
		'maxFileCount' => 10 // Client max files
	]
]) ?>
    
    
     <?= Html::button('Create New Company', ['value' => Url::to(['masters/trabajadores']), 'title' => 'Creating New Company', 'class' => 'showModalButton btn btn-success']); ?>
    
    
    <?php ActiveForm::end(); ?>

    
    <?= \nemmo\attachments\components\AttachmentsTable::widget(['model' => $model]) ?>
    <?= \nemmo\attachments\components\AttachmentsTableWithPreview::widget(['model' => $model]) ?>
</div>
