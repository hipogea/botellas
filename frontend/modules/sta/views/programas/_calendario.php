<?php
/*
use kriss\calendarSchedule\CalendarScheduleWidget;
use yii\web\JsExpression;

 $events = array();
  //Testing
  $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 1;
  $Event->title = 'Testing';
  $Event->start = date('Y-m-d\TH:i:s\Z');
  $Event->nonstandard = [
    'field1' => 'Something I want to be included in object #1',
    'field2' => 'Something I want to be included in object #2',
  ];
  $events[] = $Event;

  $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 2;
  $Event->title = 'Testing';
  $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
  $events[] = $Event;

  ?>

  <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
     
      'events'=> $events,
  ));







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

echo CalendarScheduleWidget::widget([
    
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
 * 
 * */