<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
?>

<?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           
           
            'codparam',
            'parametros.desparam',
            'codcen',
            'valor',
            //'web',
            //'deslarga:ntext',

              /*[
                 'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}{myButton}',
                'buttons' => [
                'myButton' => function($url, $model, $key) {     // render your custom button
                    return Html::a('holis',null,["onClick"=>"alert('holis');"]);
                }
               ]*/
                
                
                
                ],
        ]
    ); ?>

<?php Pjax::end(); ?>