<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\CliproSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base.names', 'Clipros');

?>
<div class="box box-success">
<div class="clipro-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'summary' => '',
        //'tableOptions'=>['class'=>".thead-dark table table-condensed table-hover table-bordered table-striped"],
        'columns' => [
           [
                 'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                /*'buttons' => [
                'myButton' => function($url, $model, $key) {     // render your custom button
                    return Html::a('holis',null,["onClick"=>"alert('holis');"]);
                }
               ]*/
                
                
                
                ],
           
            'codpro',
            'despro',
            'rucpro',
            'telpro',
            'web',
            //'deslarga:ntext',

              
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    
</div>
