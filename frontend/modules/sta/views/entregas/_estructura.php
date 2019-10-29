<?php use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\FileHelper;
?>
<div class="alert alert-warning">
    <span class="fa fa-file-archive-o" style="font-size:20px;"></span> <?=yii::t('import.labels','Esta es la estructura del archivo de carga solicitado para '
            . 'cargar la tabla '.FileHelper::getShortName($model->modelo)) ?>
</div>
<div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProviderFields,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
      //  'filterModel' => $searchModel,
        'columns' => [
            
            'orden',
            'aliascampo',
            'sizecampo',
            'tipo',
           
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
             
        return ($model->esforeign)? FileHelper::getShortName($model->cargamasiva->modelAsocc()->obtenerForeignClass($model->nombrecampo)):'';
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

            
        ],
    ]); ?>

</div>