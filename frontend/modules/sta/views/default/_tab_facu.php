
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use common\helpers\h;
use frontend\modules\sta\helpers\comboHelper;
use yii\bootstrap\ActiveForm;

$this->title = 'Profile';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
   

    

    <br>
   
       
             
            <?php /*h::user()->switchIdentity($identidad);*/ ?>
            
              <?php 
              $form = ActiveForm::begin(['id' => 'facultades-form','options' => ['enctype' => 'multipart/form-data']]); ?>
              <?php foreach($userfacultades as $userfacultad) { 
                  echo $this->render('checkboxfacultad',['form'=>$form,'userfacultad'=>$userfacultad]);
               
               } ?> 
              <?php ActiveForm::end(); ?>
            
            
        
 
</div>
    

