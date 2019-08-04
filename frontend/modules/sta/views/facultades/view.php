<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Facultades */

$this->title = $model->codfac;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Facultades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="facultades-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('base.names', 'Update'), ['update', 'id' => $model->codfac], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base.names', 'Delete'), ['delete', 'id' => $model->codfac], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base.names', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codfac',
            'desfac',
            'code1',
            'code2',
            'code3',
        ],
    ]) ?>

</div>
