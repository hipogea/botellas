<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = yii::t('base.actions','View {name}',['name'=>$model->nombrecompleto]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.actions', 'Workers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->codigotra;
\yii\web\YiiAsset::register($this);
?>
<div class="trabajadores-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('base.verbs', 'Update'), ['update', 'id' => $model->codigotra], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base.verbs', 'Delete'), ['delete', 'id' => $model->codigotra], [
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
