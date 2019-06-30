<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\Docbotellas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('bigitems.errors', 'Docbotellas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="docbotellas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('bigitems.errors', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('bigitems.errors', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('bigitems.errors', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codestado',
            'codpro',
            'numero',
            'codcen',
            'descripcion',
            'codenvio',
            'fecdocu',
            'fectran',
            'codtra',
            'codven',
            'codplaca',
            'ptopartida_id',
            'ptollegada_id',
            'comentario:ntext',
            'essalida',
        ],
    ]) ?>

</div>
