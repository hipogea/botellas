<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sociedades */

$this->title = Yii::t('control.errors', 'Update Sociedades: {name}', [
    'name' => $model->socio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('control.errors', 'Sociedades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->socio, 'url' => ['view', 'id' => $model->socio]];
$this->params['breadcrumbs'][] = Yii::t('control.errors', 'Update');
?>
<div class="sociedades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
