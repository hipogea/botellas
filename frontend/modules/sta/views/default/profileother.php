
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use common\helpers\h;
use yii\bootstrap\ActiveForm;

$this->title = 'Profile';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h6><?= Html::encode($this->title) ?></h6>

    
<div class="box box-success">
    <br>
    <div class="row">
        <div class="col-lg-5">
             
            <?php /*h::user()->switchIdentity($identidad);*/ ?>
            
              <?php 
              $form = ActiveForm::begin(['id' => 'profile-form','options' => ['enctype' => 'multipart/form-data']]); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <?=Html::img($profile->getUrlImage(), ['border'=>2,'width'=>120,'height'=>120])
             
              ?>
                    </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.forms','User id'),'45545ret',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', $model->username,['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.names','Last Login'),'fd5656',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', $model->lastLoginForHumans(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.names','Created at'),'fdtt5656',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', $model->getSince(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= SwitchInput::widget(['name'=>'status_1','disabled'=>false]);?>  
            </div>
           
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.names','E-mail'),'fd56t56',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', $model->email,['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= Html::checkbox('agreeff', false, [ 'disabled'=>'disabled', 'label' =>yii::t('base.forms','Enabled')]) ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($profile, 'names')->textInput([]) ?>
                    </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($profile, 'duration')->textInput([]) ?>
                    </diV>
            
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($profile, 'durationabsolute')->textInput([]) ?>
                    </diV>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?php
// Usage with ActiveForm and model and initial value set to true
//$model->status = true;
echo $form->field($model, 'status')->checkbox();
                
?>
                    
                </div>
              

 
               
                
            <?php ActiveForm::end(); ?>
            
            
        </div>
    </div>
</div>
    </div>

