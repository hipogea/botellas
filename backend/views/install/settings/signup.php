<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="install-image"></div>

        <div class="install-content">
            <div class="install-logo">
                <img src=" <?= yii\helpers\Url::to("@web/img/akaunting-logo-white.png") ?> " alt="Akaunting" />
            </div>

            <div class="box box-success box-solid">
                <div class="box-header">
                    <div class="col-md-12">
                        <h3 class="box-title">Setting Server Mail</h3>
                    </div>
                </div>
                <!-- /.box-header -->

              
                
                <div id="install-form">
  
 <?= Html::errorSummary($model)?>
 
    <div class="box-body">
                        <div id="install-loading"></div>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'retypePassword')->passwordInput() ?>
                <div class="box-footer">
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-8 text-right">
                                 <?= Html::submitButton(Yii::t('install.procedures', 'Next'), ['id' => 'next-button','class' => 'btn btn-success']) ?>
                                
                            </div>
                        </div>
                    </div>
            <?php ActiveForm::end(); ?>
                </div>
            </div>
          </div>
</div>
