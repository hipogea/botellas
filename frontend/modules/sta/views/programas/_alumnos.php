<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use kartik\grid\GridView ;
use frontend\modules\sta\helpers\comboHelper;

?>


<button id="boton-refrescar" type="button" class="btn btn-warning btn-lg">
    <span class="glyphicon glyphicon-refresh"></span><?=yii::t('sta.labels','  Actualizar lista')?></button>
<div class="talleres-index">

    <div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <div style='overflow:auto;'>
   <?php 
   $dataTutores= comboHelper::getCboTutoresByProg($model->id);
   //print_r($dataTutores);die();
   $gridColumns = [
[
    
                'class' => 'yii\grid\ActionColumn',
   ], 
[
    'class' => 'kartik\grid\ExpandRowColumn',
   'detailRowCssClass'=>'',
    'width' => '50px',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    'detail' => function ($model, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('_form_view_alu', ['model' => $model]);
    },
    'expandOneOnly' => true
],

[  'attribute' => 'ap',
],
[  'attribute' => 'nombres', 
],
         
[ 
    'attribute' => 'codalu', 
],

           
            
 /*[
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'codtra',
    'editableOptions'=>[
        //'header'=>'Tutor',
       // 'formOptions'=>['action' => ['/book/editbook']], // point to the new action        
        'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
        'data'=>[], // any list of values
       //'options' => ['class'=>'form-control'],
        
    ],*/
     
     [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'codtra',
           // 'pageSummary' => 'Total',
            'editableOptions'=>[
                'inputType' => Editable::INPUT_DROPDOWN_LIST,
                'data'=>$dataTutores ,
                'formOptions'=>['action' => [$this->context->id.'/edit-tutor']], // point to the new action 
                //'editableKey'=>'holis',
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
         ]
         
    /*'hAlign'=>'right',
    'vAlign'=>'middle',
    'width'=>'100px',*/
  
    

/*[
    'class' => 'kartik\grid\CheckboxColumn',
   // 'headerOptions' => ['class' => 'kartik-sheet-style'],
    'pageSummary' => '<small>(amounts in $)</small>',
    //'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
],*/
];
   
   
   
   
   Pjax::begin(['id'=>'grilla-minus']); ?>
        <?= GridView::widget([
        'dataProvider' => $dataProviderAlumnos,
         //'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'filterModel' => $searchAlumnos,
        'columns' => $gridColumns,
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
                              $.pjax.defaults.timeout = false;  
                       // $.pjax.reload({container: '#grilla-minus'});
                        },
   cache: true
  })
 }
 
);",\yii\web\View::POS_END);  
  ?>