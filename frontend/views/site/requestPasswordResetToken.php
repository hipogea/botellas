<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = yii::t('base.verbs','Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<br><br>
<div style=" width: 400px;
  margin-left: auto;
  margin-right: auto;
  margin-top: auto;
  ">
<div class="box box-success">
<div class="site-request-password-reset">
    <h3><?= Html::encode($this->title) ?></h3>

    <p><?= yii::t('base.actions','Please fill out your email. A link to reset password will be sent there.') ?></p>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4><i class="icon fa fa-check"></i>Saved!</h4>
         <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>


<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4><i class="icon fa fa-check"></i><?=yii::t('base.errors','Sorry') ?></h4>
         <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                  <?= Html::a(yii::t('base.verbs','Back to Home'), \yii\helpers\Url::to('index')) ?>
            <br>
 <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(yii::t('base.verbs','Send'), ['class' => 'btn btn-success']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>
    </div>