<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\DireccionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base.names', 'Direcciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direcciones-index">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('base.names', 'Create Direcciones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions' =>['class' => 'table table-striped table-dark'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'direc',
            'nomlug',
            'distrito',
            'provincia',
            //'departamento',
            //'latitud',
            //'meridiano',
            //'codpro',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>