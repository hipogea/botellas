<?php
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">

    <?php $form = ActiveForm::begin(['options'=>['enctype' => 'multipart/form-data'],'fieldClass' => '\common\components\MyActiveField']); ?>
       
    <?= $form->field($model, 'codigotra')->textInput(['maxlength' => true]) ?>
  
    
    <?= $form->field($model, 'ap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pasaporte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codpuesto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cumple')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecingreso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telfijo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telmoviles')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('control.errors', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    echo Typeahead::widget([
    'name' => 'country',
    'options' => ['placeholder' => 'Filter as you type ...'],
    'pluginOptions' => ['highlight'=>true],
    'dataset' => [
        [
            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
            'display' => 'value',
           // 'prefetch' => $baseUrl . '/samples/countries.json',
            'remote' => [
                'url' => Url::to(['site/country-list']) . '?q=%QUERY',
                'wildcard' => '%QUERY'
            ]
        ]
    ]
]);
 
    ?>
    
    
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
