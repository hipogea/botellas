<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\Guia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('bigitems.labels', 'Guias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="guia-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('bigitems.labels', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('bigitems.labels', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('bigitems.labels', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'numgui',
            'descripcion',
            'serie',
            'codpro',
            'codpro_tran',
            'fecha',
            'fecha_tran',
            'codestado',
            'chofer',
            'codmotivo',
            'placa',
            'confvehicular',
            'brevete',
            'ptopartida_id',
            'ptollegada_id',
            'codcen',
            'codocu',
            'comentario:ntext',
            'essalida',
        ],
    ]) ?>

</div>
