<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\import\models\ImportCargamasivaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('import.labels', 'Import Cargamasivas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="import-cargamasiva-index">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('import.labels', 'Create Import Cargamasiva'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'user_id',
            'insercion',
            'escenario',
            'lastimport',
            //'descripcion',
            //'format',
            //'modelo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>