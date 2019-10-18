<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\sta\helpers\comboHelper;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Carreras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carreras-form">
    <br>
    <?php $form = ActiveForm::begin(); ?>
<div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton(Yii::t('sta.labels', 'Save'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>

 <div class="box-body">
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?= $form->field($model, 'codcar')->textInput(['maxlength' => true]) ?>

 </div> 
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?= $form->field($model, 'descar')->textInput(['maxlength' => true]) ?>

 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
   <?= $form->field($model, 'codfac')->
            dropDownList(comboHelper::getCboFacultades(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                     //'class'=>'probandoSelect2',
                        ]
                    ) ?>

 </div>  
 

    <?php ActiveForm::end(); ?>

</div>
