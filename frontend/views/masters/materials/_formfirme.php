<?php
use yii\helpers\Url;
//use yii\grid\GridView;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
///se yii\widgets\Pjax;
use kartik\tabs\TabsX;

  //use common\models\masters\Clipro;
//use common\models\masters\Direcciones;

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
            'content' => $this->render('_form',['model'=>$model]),
            'active' => true
        ],
        [
            'label' => yii::t('base.names','Conversion'),
         'content' => $this->render('_tab_conversiones',['model'=>$model,'probConversiones'=>$probConversiones]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID1'],
            'active' => false
        ],
        [
            'label' => yii::t('base.names','Centers'),
            'content' => $this->render('_tab_centros',['model'=>$model]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID2'],
            'active' => false
        ],
        
    ],
]);    
    
    ?>
    


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</div>
