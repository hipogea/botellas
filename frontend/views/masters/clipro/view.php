<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */

$this->title = Yii::t('base.verbs', 'View').'   -   '.$model->despro;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Clipros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="box box-success">
<div class="clipro-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('base.verbs', 'Update'), ['update', 'id' => $model->codpro], ['class' => 'btn btn-primary']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codpro',
            'despro',
            'rucpro',
            'telpro',
            'web',
            'deslarga:ntext',
        ],
    ]) ?>

</div>
</div>