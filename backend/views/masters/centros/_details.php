<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\grid\GridView as grid;
?>

<?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);
    $gridColumns=[
        'codparam',
        'parametros.desparam',
       [
            'class' => 'kartik\grid\EditableColumn',
            'editableOptions'=>[
                'data'=>['miamiga'=>'karina'],
            ],
            'attribute' => 'valor',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '210px',
           //'data'=>['modelo'=>'mimodelo']
            
         ],
       
   ];
    ?>
    <?php echo grid::widget([
    'dataProvider'=> $dataProvider,
   'filterModel' => $searchModel,
       'summary' => '',
    'columns' => $gridColumns,
    'responsive'=>true,
    'hover'=>true
       ]);
?>
   

<?php Pjax::end(); ?>