<?php
use yii\helpers\Url;

use yii\helpers\Html;
use yii\widgets\ActiveForm;





/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */
/* @var $form yii\widgets\ActiveForm */
?>

    
<div class="box box-success">
<div class="clipro-form">

<div class="receipt-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'codpro')->textInput(['value'=>$modelclipro->codpro,'maxlength' => true]) ?>
    
    </div>
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
      </div>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
       
    </div>

    <?php ActiveForm::end(); ?>

</div>
    </div>
</div>
