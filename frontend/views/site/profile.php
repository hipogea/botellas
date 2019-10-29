
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\helpers\h;
use yii\bootstrap\ActiveForm;

$this->title = 'Profile';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h6><?= Html::encode($this->title) ?></h6>
 <div class="box box-success">
    

 
        
             
            
            
              <?php  
              $form = ActiveForm::begin(['id' => 'profile-form','options' => ['enctype' => 'multipart/form-data']]); ?>
                  
     <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton(Yii::t('sta.labels', 'Guardar'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
     
     
               <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= \common\widgets\imagewidget\ImageWidget::widget(['name'=>'imagenrep','model'=>$model]); ?>
   </div>
    
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.names','Usuario'),'45545ret',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::userName(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.names','Ultimo acceso'),'fd5656',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::user()->lastLoginForHumans(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base.names','Creado'),'fdtt5656',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::user()->getSince(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?=$form->field($identidad,'email')->textInput() ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= Html::checkbox('agreeff',h::user()->isActive(), [ 'disabled'=>'disabled', 'label' =>yii::t('base.forms','Enabled')]) ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'names')->textInput(['autofocus' => true]) ?>
                    </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'duration')->textInput(['autofocus' => true]) ?>
                    </diV>
            
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'durationabsolute')->textInput(['autofocus' => true]) ?>
                    </diV>
       
                
            
               
                
            <?php ActiveForm::end(); ?>
            
            
       
    </div>
    <br>
</div>
   
</div>
