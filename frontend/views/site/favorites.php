
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
    <div class="row">
        
             
            
            
              <?php 
     
              $form = ActiveForm::begin(['id' => 'profile-form','options' => ['enctype' => 'multipart/form-data']]); ?>
                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'url')->textInput(['autofocus' => true]) ?>
                    </diV>  
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'alias')->textInput(['autofocus' => true]) ?>
                    </diV>  
            
           
               
              

                

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                
            <?php ActiveForm::end(); ?>
            
            
        </div>
    </div>
</div>
    </div>

