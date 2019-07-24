<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\ValoresdefaultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base.names', 'Valoresdefaults');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valoresdefault-index">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('base.names', 'Create Valoresdefault'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codocu',
            'user_id',
            'nombrecampo',
            'valor:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>