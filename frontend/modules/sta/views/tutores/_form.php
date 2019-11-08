<?php
use kriss\calendarSchedule\CalendarScheduleWidget;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\h;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borereuccess">   
    
     
      <div class="box-body">
        
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
                 <?=Html::label(yii::t('sta.labels','Tutor'),'trabajadores_caja',['class'=>'control-label']) ?> 
                <?=Html::textInput('mytexto',$model->trabajador->fullName(),['id' =>'trabajadores_caja','class'=>'form-group form-control']) ?>

            </div>
   <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
              <?php
               $events = array();
  //Testing
  $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 1;
  $Event->title = 'Testing s';
  //$Event->start = date('Y-m-d\TH:i:s\Z');
  $Event->start = date('Y-m-d\TH:i:s\Z',time());
   $Event->backgroundColor ='#fa3';
  $Event->end = date('Y-m-d\TH:i:s\Z',time()+60*3600);
  
  $events[] = $Event;
   $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 3;
  $Event->title = 'prueba';
  //$Event->start = date('Y-m-d\TH:i:s\Z');
  $Event->start = date('Y-m-d\TH:i:s\Z',time()-2*3600);
   $Event->backgroundColor ='#0a3';
  $Event->end = date('Y-m-d\TH:i:s\Z',time()+2*3600);
  
  $Event->nonstandard = [
    'field1' => 'Something I want to be included in object #1',
    'field2' => 'Something I want to be included in object #2',
  ];
  $events[] = $Event;

  $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 2;
  $Event->title = 'Testing 2';
  $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 3pm'));
  $events[] = $Event;
  
  ?>
  <?=\yii2fullcalendar\yii2fullcalendar::widget(array(
     'id'=>'2345calendario',
      'events'=> $events,
  )); ?>
         
<?php


$jsRemoveCallback = <<<JS
function(title) {
  console.log('removeCallback', title);
}
JS;

$jsCreateCallback = <<<JS
function(title, color) {
  console.log('createCallback', title, color);
}
JS;
 CalendarScheduleWidget::widget([
    
    'draggableEvents' => [
        'items' => [
            ['name' => 'item1', 'color' => '#286090'],
            ['name' => 'item2', 'color' => '#f0ad4e'],
        ],
        'removeCallback' => new JsExpression($jsRemoveCallback)
    ],
    'createEvents' => [
        'colors' => ['#286090', '#5cb85c', '#5bc0de', '#f0ad4e', '#d9534f'],
        'createCallback' => new JsExpression($jsCreateCallback)
    ],
    'fullCalendarOptions' => [
         'locale'=>'es',   
        'events' => [
            ['title' => 'evento 1', 'start' => date('Y-m-d 10:00:00'), 'end' => date('Y-m-d 20:00:00'), 'color' => '#286090'],
            ['title' => 'evento 2', 'start' => date('Y-m-10 10:00:00'), 'allDay' => true, 'color' => '#5bc0de'],
        ],
        'eventReceive' => new JsExpression("function(event) { console.log('eventReceive', event) }"),
        'eventDrop' => new JsExpression('function(event) {console.log("eventDrop", event)}'),
        'eventResize' => new JsExpression('function(event) {console.log("eventResize", event)}'),
        'eventClick' => new JsExpression('function(event) {console.log("eventClick", event)}'),
    ]
]);


?>
    </div>   
     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">    
      <?php  $gridColumns = [
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

];
   
  
   
   
   ?>
        <?php 
        Pjax::begin(['id'=>'sumilla']);
        echo GridView::widget([
             'id' => 'kv-grid-demo',
        'dataProvider' => $dataProvider,
         //'summary' => '',
        // 'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        //'filterModel' => $searchAlumnos,
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
</div>
    </div>
