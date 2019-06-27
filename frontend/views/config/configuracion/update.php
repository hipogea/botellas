<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\config\Configuracion */

$this->title = Yii::t('control.errors', 'Update Configuracion: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('control.errors', 'Configuracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('control.errors', 'Update');
?>
<div class="configuracion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
