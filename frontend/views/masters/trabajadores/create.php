<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = Yii::t('base.actions', 'Create Worker', [
    'name' => $model->codigotra,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('control.errors', 'Trabajadores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trabajadores-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
