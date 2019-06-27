<?php

use yii\helpers\Html;
use common\helpers\ComboHelper;
use yii\widgets\ActiveForm;
use kartik\editable\Editable;
/* @var $this yii\web\View */
/* @var $model frontend\modules\report\models\Reporte */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$papeles =['A3'=>'A3','A4'=>'A4','A5-L'=>'A5-L','A5'=>'A5','Letter'=>'Letter','A3-L'=>'A3-L','A4-L'=>'A4-L','Letter-L'=>'Letter-L'];

        
?>
<div class="reporte-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'xgeneral')->textInput() ?>
    </div>
     
    
    
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'ygeneral')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'xlogo')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'ylogo')->textInput() ?>
 </div>
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'codocu')->
            dropDownList(ComboHelper::getCboDocuments(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'role')->
            dropDownList(ComboHelper::getCboRoles(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'codcen')->
            dropDownList(ComboHelper::getCboCentros(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'modelo')->
            dropDownList(ComboHelper::getCboModels(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <?= $form->field($model, 'imagen')->textInput(['disabled'=>'disabled']) ?>
    <?= \nemmo\attachments\components\AttachmentsInput::widget([
	'id' => 'file-input', // Optional
	'model' => $model,         
	'options' => [ // Options of the Kartik's FileInput widget
		'multiple' => false, // If you want to allow multiple upload, default to false
	//'overwriteInitial'=>false,
            ],
	'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
            
    'allowedFileExtensions'=>["jpg", "png", "gif"],
    'maxImageWidth'=>800,
    'maxImageHeight'=>800,
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
     </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'nombrereporte')->textInput(['maxlength' => true]) ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'detalle')->textarea(['rows' => 6]) ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'campofiltro')->textInput(['maxlength' => true]) ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'tamanopapel')->
            dropDownList($papeles,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'x_grilla')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'y_grilla')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'registrosporpagina')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'tienepie')->checkbox() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'tienelogo')->checkbox() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'xresumen')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'yresumen')->textInput() ?>
 </div>
 
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'comercial')->checkbox() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'tienecabecera')->checkbox() ?>
 </div>
    
     <?= Html::dropDownList('parentmodels', ' ', $model->parentModels(), []);?>
     
    
    <div class="form-group">
        
        <?= Html::submitButton(Yii::t('report.messages', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    
    <?php
use yii\widgets\Pjax;

?>
    <div style="overflow:auto;" >
<?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= kartik\grid\GridView::widget([
        'id'=>'detallerepoGrid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{editar}',
                'buttons' => [
	
                 'editar' => function ($url,$model) {
			    $url = \yii\helpers\Url::to(['updatedetallerepo','id'=>$model->id,'nombregrilla'=>'detalleRepoGrid']);
                             return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                            }
                        ],
            ],
           'nombre_campo',
             [
                        'class' => 'kartik\grid\EditableColumn',
                        'editableOptions'=>[
                                            ],
                        'attribute' => 'font_size',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
            
             // any list of values
            
            
             'aliascampo',
            'tipodato',
            'esdetalle',
            [
                        'class' => 'kartik\grid\EditableColumn',
                
                        'editableOptions'=>[
                            'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                             'data'=>['arial'=>'arial','courier'=>'courier'], 
                                            ],
                        'attribute' => 'font_family',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
            [
                        'class' => 'kartik\grid\EditableColumn',
                
                        'editableOptions'=>[
                            'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                             'data'=>['1'=>'Yes',''=>'No'], 
                                            ],
                        'attribute' => 'visiblecampo',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
	    [
                        'class' => 'kartik\grid\EditableColumn',
                        'editableOptions'=>[
                                            ],
                        'attribute' => 'left',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],  
            [
                        'class' => 'kartik\grid\EditableColumn',
                        'editableOptions'=>[
                                            ],
                        'attribute' => 'top',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
		  
		   'font_weight',
		   'font_color',		  
		   'lbl_left',
		   'lbl_top',
		   'lbl_font_size',
		   'lbl_font_family',
		   'visiblelabel',
		   'lbl_font_color',
		  // 'visiblecampo',
		  // 'hidreporte',		  
		    'longitudcampo',
		  // 'tipodato',
                ],
        ]
    ); ?>

<?php Pjax::end(); ?>
  </div>  
    
    
    
    
    
    
    
    
    
</div>
