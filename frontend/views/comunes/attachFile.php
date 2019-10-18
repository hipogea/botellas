<?php use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


    <?php $form = ActiveForm::begin(); ?>
 <?= \nemmo\attachments\components\AttachmentsInput::widget([
	'id' => 'file-input', // Optional
	'model' => $model,         
	'options' => [ // Options of the Kartik's FileInput widget
		'multiple' => false, // If you want to allow multiple upload, default to false
	//'overwriteInitial'=>false,
            ],
	'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
            
    'allowedFileExtensions'=>$allowedExtensions,
    'maxImageWidth'=>3800,
    'maxImageHeight'=>3800,
    'resizePreference'=>'height',
    'maxFileCount'=>1,
    'resizeImage'=>true,
    'resizeIfSizeMoreThan'=>100,
            'previewFileType' => 'any',
		'maxFileCount' => 1 ,// Client max files
           'overwriteInitial'=>false,
             //'maxFileSize'=>800,
            'resizeImages'=>true,
	]
]) ?> 

<div class="form-group">
        
        <?= Html::submitButton(Yii::t('report.messages', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
 <?php ActiveForm::end(); ?>