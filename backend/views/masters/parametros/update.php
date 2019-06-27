<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Parametros */

$this->title = Yii::t('app', 'Update Parametros: {name}', [
    'name' => $model->codparam,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parametros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codparam, 'url' => ['view', 'id' => $model->codparam]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="parametros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
