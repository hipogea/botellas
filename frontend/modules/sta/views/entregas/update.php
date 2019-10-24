<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Entregas */

$this->title = Yii::t('sta.labels', 'Update Entregas: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Entregas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sta.labels', 'Update');
?>
<div class="entregas-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>


</div>