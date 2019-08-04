<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;



/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */
/* @var $form yii\widgets\ActiveForm */
?>

    

<div class="clipro-form">


<?php

echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => yii::t('base.names','General'),
            'content' => $this->render('_form',['model'=>$model,'items'=>$items]),
            'active' => true,
             'options' => ['id' => 'myveryryyownID2'],
        ],
        [
            'label' => yii::t('base.names','Config'),
         'content' => $this->render('_tab_config',[]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID1'],
            'active' => false
        ],
        [
            'label' => yii::t('base.names','Audit'),
            'content' => $this->render('_tab_audit',[]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID2'],
            'active' => false
        ],
        
    ],
]);    
    
    ?>

