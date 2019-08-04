<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Carreras */

$this->title = $model->codcar;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Carreras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="carreras-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('base.names', 'Update'), ['update', 'id' => $model->codcar], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base.names', 'Delete'), ['delete', 'id' => $model->codcar], [
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
            'codcar',
            'codfac',
            'descar',
            'code1',
            'code2',
            'code3',
        ],
    ]) ?>

</div>
