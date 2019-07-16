<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\selectwidget\selectWidget;
/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\DocbotellasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docbotellas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

  

  

     
   <?php 
   //var_dump($model->fieldsLink(false));die();
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codpro',
           'multiple'=>'multiple',
            //'foreignskeys'=>[1,2,3],
        ]);  ?>
    
    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'codcen') ?>
    
    <?= $form->field($model, 'fectran') ?>
      <?= $form->field($model, 'fectran1') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'codenvio') ?>

    <?php // echo $form->field($model, 'fecdocu') ?>

    <?php // echo $form->field($model, 'fectran') ?>

    <?php // echo $form->field($model, 'codtra') ?>

    <?php // echo $form->field($model, 'codven') ?>

    <?php // echo $form->field($model, 'codplaca') ?>

    <?php // echo $form->field($model, 'ptopartida_id') ?>

    <?php // echo $form->field($model, 'ptollegada_id') ?>

    <?php // echo $form->field($model, 'comentario') ?>

    <?php // echo $form->field($model, 'essalida') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('bigitems.errors', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('bigitems.errors', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

