<?php use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'descripcion',
            'fechacarga',
            'tienecabecera',
            'duracion',
            'activo',
            //'descripcion',
            //'format',
            //'modelo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>



    
    

    
  