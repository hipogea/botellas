<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\Guia */

$this->title = Yii::t('bigitems.labels', 'Update Guia: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('bigitems.labels', 'Guias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('bigitems.labels', 'Update');
?>
<div class="guia-update">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>