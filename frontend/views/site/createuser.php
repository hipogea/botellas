<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use mdm\admin\components\UserStatus;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = yii::t('base.verbs','Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div style=" width: 400px;
  margin-left: auto;
  margin-right: auto;
  margin-top: auto;
  ">
    <br>
    <div class="box box-success">
        <div class="box-body">
<div class="site-signup">
    <h3><?= Html::encode($this->title) ?></h3>

    <p><?=yii::t('base.actions','Please fill out the following fields to signup:')?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
      
                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(yii::t('base.names','UserName')) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
              
     <?= $form->field($model, 'status')->
            dropDownList([UserStatus::ACTIVE=>yii::t('base.names','Enabled'),UserStatus::INACTIVE=>yii::t('base.names','Disabled')] ,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
            

                <div class="col-md-4 col-md-offset-8 text-right">
                                 <?= Html::submitButton(Yii::t('base.verbs', 'Signup'), ['id' => 'next-button','class' => 'btn btn-success']) ?>
                                
                            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
    </div>
       </div> 
    </div>

