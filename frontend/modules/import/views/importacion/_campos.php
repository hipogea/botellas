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

            'aliascampo',
            'sizecampo',
            'tipo',
            'orden',
         [
    'attribute' => 'requerida',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('requerida[]', $model->requerida, [ 'disabled' => true]);

             },

          ],
   
                     [
    'attribute' => 'esforeign',
    'format' => 'raw',
    'value' => function ($model) {
             
        return ($model->esforeign)?$model->cargamasiva->modelAsocc()->obtenerForeignClass($model->nombrecampo):'';
             },

          ],
         [
    'attribute' => 'esforeign',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('esforeing[]', $model->esforeign, [ 'disabled' => true]);

             },

          ],
            //'descripcion',
            //'format',
            //'modelo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
    



    
    

    
  