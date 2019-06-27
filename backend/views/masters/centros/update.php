<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Centros */

$this->title = Yii::t('app', 'Update Centros: {name}', [
    'name' => $model->codcen,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Centros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codcen, 'url' => ['view', 'id' => $model->codcen]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="centros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
         'dataProvider' => $dataProvider,
    ]) ?>

</div>
