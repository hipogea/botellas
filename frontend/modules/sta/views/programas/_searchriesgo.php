<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\GuiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guia-search">

    <?php $form = ActiveForm::begin([
        //'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    
     <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
           <?= Html::submitButton(Yii::t('bigitems.labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('bigitems.labels', 'Reset'), ['class' => 'btn btn-default']) ?>
   

            </div>
        </div>
    </div>
    
    
    
    
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codalu') ?>
    </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'nomcur') ?>
     </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'ap') ?>
     </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'nombres') ?> 
</div>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'dni') ?>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'correo') ?>
       </div>  
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codfac') ?>
         </div>    
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'codcar') ?>
 </div>
    <?php // echo $form->field($model, 'codpro_tran') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'fecha_tran') ?>

    <?php // echo $form->field($model, 'codestado') ?>

    <?php // echo $form->field($model, 'chofer') ?>

    <?php // echo $form->field($model, 'codmotivo') ?>

    <?php // echo $form->field($model, 'placa') ?>

    <?php // echo $form->field($model, 'confvehicular') ?>

    <?php // echo $form->field($model, 'brevete') ?>

    <?php // echo $form->field($model, 'ptopartida_id') ?>

    <?php // echo $form->field($model, 'ptollegada_id') ?>

    <?php // echo $form->field($model, 'codcen') ?>

    <?php // echo $form->field($model, 'codocu') ?>

    <?php // echo $form->field($model, 'comentario') ?>

    <?php // echo $form->field($model, 'essalida') ?>

   

    <?php ActiveForm::end(); ?>

</div>
