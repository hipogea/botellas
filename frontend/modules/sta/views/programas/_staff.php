<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<div class="talleres-index">

    
   
     <div class="box-body">
    <?php Pjax::begin(['id'=>'grilla-staff']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProviderStaff,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}{view}',
                'buttons' => [
                   
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                         'delete' => function($url, $model) {                        
                        $options = [
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'title' => Yii::t('base.verbs', 'Delete'),                            
                        ];
                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', $url, $options/*$options*/);
                         }
                    ]
                ],
         
         
         
         
         

           
            'trabajadores.ap',
                             'trabajadores.am',
                             'trabajadores.nombres',
            [
                'attribute'=>'nalumnos',
                'format'=>'raw',
                'value' => function ($model, $key, $index, $column) {
                    return '<span class="badge badge-success" >'.$model->nalumnos.'</span>';
                        },
                ]
            //'fclose',
            //'codcur',
            //'activa',
            //'codperiodo',
            //'electivo',
            //'ciclo',

          
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
  
       
<?php
 $url= Url::to(['agrega-psico','id'=>$model->id,'gridName'=>'grilla-staff','idModal'=>'buscarvalor']);
   echo  Html::button(yii::t('base.verbs','Create'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
?> 
