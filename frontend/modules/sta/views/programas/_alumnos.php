<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use kartik\grid\GridView as grid;
?>
<button id="boton-refrescar" type="button" class="btn btn-warning btn-lg">
    <span class="glyphicon glyphicon-refresh"></span><?=yii::t('sta.labels','  Actualizar lista')?></button>
<div class="talleres-index">

    <div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <div style='overflow:auto;'>
   <?php Pjax::begin(); ?>
        <?= grid::widget([
        'dataProvider' => $dataProviderAlumnos,
         //'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'filterModel' => $searchAlumnos,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}{view}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'Update'),                            
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
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
         
         [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'codtra',
            'pageSummary' => 'Total',
            'editableOptions'=>[
                'inputType' => Editable::INPUT_DROPDOWN_LIST,
                'data'=>['1'=>'UNO','2'=>'DOS'] ,
                //'ajaxSettings'=>['data'=>['karina'=>'toledo']],
            ],
            'vAlign' => 'middle',
            'width' => '210px',
           //'data'=>['modelo'=>'mimodelo']
           // 'editableOptions'=> [
            //'attribute'=>'status_id',
            //'value'=>'status.related_value',
          //'header' => 'profile',
          //'format' => Editable::FORMAT_BUTTON,
          
        //]
         ],
         
         
            'ap',
            'am',
               'codalu',         
            'nombres',

           // 'id',
           // 'codfac',
           // 'codtra',
           // 'codtra_psico',
           // 'fopen',
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
  
  <?php    $this->registerJs("
         
$('#boton-refrescar').on( 'click', function(){    
  $.ajax({ 
  
   method:'post',    
      url: '".\yii\helpers\Url::toRoute('/sta/programas/refresca-alumnos')."',
   delay: 250,
 data: {id:".$model->id."},
             error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(json) {  
                        var n = Noty('id');
                       if ( !(typeof json['error']==='undefined') ) {
                                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error'); 
                              }
                         if ( !(typeof json['success']==='undefined') ) {
                                        $.noty.setText(n.options.id, json['success']);
                             $.noty.setType(n.options.id, 'success');
                              } 
                               if ( !(typeof json['warning']==='undefined') ) {
                                        $.noty.setText(n.options.id, json['warning']);
                             $.noty.setType(n.options.id, 'warning');
                              } 
                        $.pjax({container: '#grilla-minus'});
                        },
   cache: true
  })
 }
 
);",\yii\web\View::POS_END);  
  ?>