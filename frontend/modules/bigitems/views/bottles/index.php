<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\bigitems\models\DocbotellasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('bigitems.errors', 'Docbotellas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docbotellas-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
       <div class="box box-body"> 
    <?php Pjax::begin(); ?>
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('bigitems.errors', 'Create Docbotellas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [            
            'numero',
            'codpro',
            'despro', 
            'codigo',
            'fectran',
            'fecdocu',
            'descripcion',
            'direcllegada',
            //'despro',
            //'descripcion',
            //'codenvio',
            //'fecdocu',
            //'fectran',
            //'codtra',
            //'codven',
            //'codplaca',
            //'ptopartida_id',
            //'ptollegada_id',
            //'comentario:ntext',
            //'essalida',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
    </div>