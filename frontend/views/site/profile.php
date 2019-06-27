
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\helpers\h;
use yii\bootstrap\ActiveForm;

$this->title = 'Profile';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h6><?= Html::encode($this->title) ?></h6>

    
<div class="box box-success">
    <div class="row">
        <div class="col-lg-5">
             
            
            
              <?php 
              $form = ActiveForm::begin(['id' => 'profile-form','options' => ['enctype' => 'multipart/form-data']]); ?>
                    
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.forms','User id'),'45545ret',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::userName(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.names','Last Login'),'fd5656',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::user()->lastLoginForHumans(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.names','Created at'),'fdtt5656',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::user()->getSince(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.names','E-mail'),'fd56t56',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::user()->identity->email,['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= Html::checkbox('agreeff',h::user()->isActive(), [ 'disabled'=>'disabled', 'label' =>yii::t('base.forms','Enabled')]) ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'names')->textInput(['autofocus' => true]) ?>
                    </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'duration')->textInput(['autofocus' => true]) ?>
                    </diV>
            
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'durationabsolute')->textInput(['autofocus' => true]) ?>
                    </diV>
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
              

                

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                
            <?php ActiveForm::end(); ?>
            
            
        </div>
    </div>
</div>
    </div>

