<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Periodos */

$this->title = Yii::t('bigitems.labels', 'Update Periodos: {name}', [
    'name' => $model->codperiodo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('bigitems.labels', 'Periodos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codperiodo, 'url' => ['view', 'id' => $model->codperiodo]];
$this->params['breadcrumbs'][] = Yii::t('bigitems.labels', 'Update');
?>
<div class="periodos-update">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>