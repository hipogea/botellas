<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\sigi\models\SigiUnidadesSearch;
    
    

$colorPluginOptions =  [
    'showPalette' => true,
    'showPaletteOnly' => true,
    'showSelectionPalette' => true,
    'showAlpha' => false,
    'allowEmpty' => false,
    'preferredFormat' => 'name',
    'palette' => [
        [
            "white", "black", "grey", "silver", "gold", "brown", 
        ],
        [
            "red", "orange", "yellow", "indigo", "maroon", "pink"
        ],
        [
            "blue", "green", "violet", "cyan", "magenta", "purple", 
        ],
    ]
];
$gridColumns = [
[
    
                'class' => 'yii\grid\ActionColumn',
   ], 
[
    'class' => 'kartik\grid\ExpandRowColumn',
    'width' => '50px',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    // uncomment below and comment detail if you need to render via ajax
    // 'detailUrl'=>Url::to(['/site/book-details']),
    'detail' => function ($model, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('_detail_unit', ['model' => $model]);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'], 
    'expandOneOnly' => true
],


[
    
    'attribute' => 'numero',
    'format'=>'raw',
    'value' => function ($model, $key, $index, $column) {
        $formato=($model->isEntregado())?'  <i style="color:#3ead05;font-size:12px"><span class="glyphicon glyphicon-check"></span></i>':
               '  <i style="color:red;font-size:12px"><span class="glyphicon glyphicon-pushpin"></span></i>';
        return $model->numero.$formato;
    },
   
],
[
    
    'attribute' => 'nombre',    
   
],
[    
    'attribute' => 'area',
],
            'tipo.desunidad',
[
    'class' => 'kartik\grid\CheckboxColumn',
    'headerOptions' => ['class' => 'kartik-sheet-style'],
    'pageSummary' => '<small>(amounts in $)</small>',
    'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
],
];

    
  echo GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider' => (New SigiUnidadesSearch())->searchByEdificio($model->id),
    //'filterModel' => $searchModel,
    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar' =>  [
    ],
    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
    // set export properties
    'export' => [
        'fontAwesome' => true
    ],
    // parameters from the demo form
   /* 'bordered' => $bordered,
    'striped' => $striped,
    'condensed' => $condensed,
    'responsive' => $responsive,
    'hover' => $hover,
    'showPageSummary' => $pageSummary,*/
    'panel' => [
        'type' => GridView::TYPE_WARNING,
        //'heading' => $heading,
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
    //'exportConfig' => $exportConfig,
    'itemLabelSingle' => yii::t('sta.labels','Unidad'),
    'itemLabelPlural' => yii::t('sta.labels','Unidades'),
]);  

?>
    
  


