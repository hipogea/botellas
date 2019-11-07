<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use frontend\modules\sigi\models\SigiApoderadosSearch;
?>
<div class="edificios-index">

     <div class="box-body">
         
<?php
 $url= Url::to(['agrega-apoderado','id'=>$model->id,'gridName'=>'grilla-apoderados','idModal'=>'buscarvalor']);
   echo  Html::button(yii::t('base.verbs','Insertar Apoderado'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Apoderado'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
?> 
         
    <?php Pjax::begin(['id'=>'grilla-apoderados']); ?>
    
   <?php //var_dump((new SigiApoderadosSearch())->searchByEdificio($model->id)); die(); ?>
    <?= GridView::widget([
        'dataProvider' =>(new SigiApoderadosSearch())->searchByEdificio($model->id),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'columns' => [
                 [
                'class' => 'yii\grid\ActionColumn',
                ],
            'codpro',
            'clipro.despro',
        ],
    ]); ?>
    <?php Pjax::end(); ?>

    </div>

       