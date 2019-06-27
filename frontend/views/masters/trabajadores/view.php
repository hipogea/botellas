<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = $model->codigotra;
$this->params['breadcrumbs'][] = ['label' => Yii::t('control.errors', 'Trabajadores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trabajadores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('control.errors', 'Update'), ['update', 'id' => $model->codigotra], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('control.errors', 'Delete'), ['delete', 'id' => $model->codigotra], [
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
            'codigotra',
            'ap',
            'am',
            'nombres',
            'dni',
            'ppt',
            'pasaporte',
            'codpuesto',
            'cumple',
            'fecingreso',
            'domicilio',
            'telfijo',
            'telmoviles',
            'referencia',
        ],
    ]) ?>

</div>
