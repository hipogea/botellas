<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
//use kartik\grid\GridView ;
use frontend\modules\sta\helpers\comboHelper;

?>


<button id="boton-refrescar" type="button" class="btn btn-warning btn-lg">
    <span class="glyphicon glyphicon-refresh"></span><?=yii::t('sta.labels','  Actualizar lista')?>
</button>


    <div class="box-body">
  
    <?php // echo $thigrids->render('_search', ['model' => $searchModel]); ?>

    
    <div style='overflow:auto;'>
   <?php 
   $dataTutores= comboHelper::getCboTutoresByProg($model->id);
   //print_r($dataTutores);die();
   $gridColumns = [
[  'attribute' => 'ap',
],
[  'attribute' => 'nombres', 
],         
[
                'attribute'=>'codalu',
                'format'=>'html',
                'value' => function ($model, $key, $index, $column) {
                    $options=['id'=>$model->codalu,
                              'class'=>'class_link_ajax'
                               ];
                    return Html::a($model->codalu, '#', $options);
                        },
],
[ 
    'attribute' => 'codtra', 
],
       [ 
    'attribute' => 'celulares', 
],
];
   
   
   
   
   ?>
        <?php 
        Pjax::begin(['id'=>'sumilla']);
        echo GridView::widget([
             'id' => 'kv-grid-demo',
        'dataProvider' => $dataProviderAlumnos,
         //'summary' => '',
        // 'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'filterModel' => $searchAlumnos,
        'columns' => $gridColumns,
           //  'pjax' => true, // pjax is set to always true for this demo
            //'toggleDataContainer' => ['class' => 'btn-group mr-2'],
           /* 'panel' => [
        'type' => GridView::TYPE_WARNING,
        //'heading' => $heading,
    ],*/
    
    ]);
        Pjax::end();
        ?>
        
    
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
                              $.pjax.defaults.timeout = false;  
                       // $.pjax.reload({container: '#grilla-minus'});
                        },
   cache: true
  })
 }
 
);",\yii\web\View::POS_END);  
  ?>

    </div>