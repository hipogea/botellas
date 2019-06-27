<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = Yii::t('app', 'Update Documentos: {name}', [
    'name' => $model->codocu,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codocu, 'url' => ['view', 'id' => $model->codocu]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="documentos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
