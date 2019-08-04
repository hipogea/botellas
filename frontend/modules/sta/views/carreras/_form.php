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
 
 <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
