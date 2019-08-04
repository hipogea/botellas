<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = Yii::t('base.actions', 'Update Worker: {name}', [
    'name' => $model->codigotra,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('control.errors', 'Trabajadores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigotra, 'url' => ['view', 'id' => $model->codigotra]];
$this->params['breadcrumbs'][] = Yii::t('control.errors', 'Update');
?>
<div class="trabajadores-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
