<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title =yii::t('base.verbs','Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<br><br>
<div style=" width: 400px;
  margin-left: auto;
  margin-right: auto;
  margin-top: auto;
  ">
    <div class="box box-success">
        <h3><?=yii::t('base.verbs','Signup')?></h3>
   <div class="alert alert-info">
       
    <?=yii::t('base.actions','Your request is waiting to be approved. You will receive an email with confirmation of the registration shortly.') ?>
   </div>   
    </div>   
</div>

