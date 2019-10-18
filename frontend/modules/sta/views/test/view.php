<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Test */

$this->title = $model->codtest;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="test-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('sta.labels', 'Update'), ['update', 'id' => $model->codtest], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('sta.labels', 'Delete'), ['delete', 'id' => $model->codtest], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('sta.labels', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codtest',
            'descripcion',
            'opcional',
            'version',
            'nveces',
        ],
    ]) ?>

</div>
