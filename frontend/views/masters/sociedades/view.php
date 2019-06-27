<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sociedades */

$this->title = $model->socio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('control.errors', 'Sociedades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sociedades-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('control.errors', 'Update'), ['update', 'id' => $model->socio], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('control.errors', 'Delete'), ['delete', 'id' => $model->socio], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('control.errors', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'socio',
            'dsocio',
            'rucsoc',
            'activo',
            'direccionfiscal',
            'telefonos',
            'web',
            'mail',
            'regimentributario',
        ],
    ]) ?>

</div>
