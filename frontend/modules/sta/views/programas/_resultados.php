<?php
<<<<<<< HEAD
\aminkt\widgets\tree\TreeView::widget([
    'data'=>['uno'=>'uno'],
    'remove'=>['bot-actions/category-remove'],
    'edit'=>['bot-actions/categories'],
]);
?>
=======
/*
use kriss\calendarSchedule\CalendarScheduleWidget;
use yii\web\JsExpression;

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
echo "hola";
echo CalendarScheduleWidget::widget([
    'draggableEvents' => [
        'items' => [
            ['name' => '洗冰箱', 'color' => '#286090'],
            ['name' => '擦玻璃', 'color' => '#f0ad4e'],
        ],
        'removeCallback' => new JsExpression($jsRemoveCallback)
    ],
    'createEvents' => [
        'colors' => ['#286090', '#5cb85c', '#5bc0de', '#f0ad4e', '#d9534f'],
        'createCallback' => new JsExpression($jsCreateCallback)
    ],
    'fullCalendarOptions' => [
        'events' => [
            ['title' => '测试', 'start' => date('Y-m-d 10:00:00'), 'end' => date('Y-m-d 20:00:00'), 'color' => '#286090'],
            ['title' => '测试', 'start' => date('Y-m-10 10:00:00'), 'allDay' => true, 'color' => '#5bc0de'],
        ],
        'eventReceive' => new JsExpression("function(event) { console.log('eventReceive', event) }"),
        'eventDrop' => new JsExpression('function(event) {console.log("eventDrop", event)}'),
        'eventResize' => new JsExpression('function(event) {console.log("eventResize", event)}'),
        'eventClick' => new JsExpression('function(event) {console.log("eventClick", event)}'),
    ]
]);
 * 
 * */
>>>>>>> 46c9670033d94783a3c0c3f438d4097f5fe28355
