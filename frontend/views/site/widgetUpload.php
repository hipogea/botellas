          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                
                    <?= \nemmo\attachments\components\AttachmentsInput::widget([
	'id' => 'file-input', // Optional
	'model' => $model,
	'options' => [ // Options of the Kartik's FileInput widget
		'multiple' => false, // If you want to allow multiple upload, default to false
	//'overwriteInitial'=>false,
            ],
	'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
            
    'allowedFileExtensions'=>["jpg", "png", "gif"],
            
   // 'maxImageWidth'=>2000,
  //  'maxImageHeight'=>2000,
    'resizePreference'=>'height',
             'maxFileSize'=>40,
    'maxFileCount'=>1,
    'resizeImage'=>true,
    'resizeIfSizeMoreThan'=>10,
            'previewFileType' => 'any',
		//'maxFileCount' => 1 ,// Client max files
           'overwriteInitial'=>false,
             //'maxFileSize'=>800,
            'resizeImages'=>true,
	]
]) ?>
                </div>