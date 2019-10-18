<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Alumnos */

$this->title = Yii::t('sta.labels', 'Editar Alumno: {name}', [
    'name' => $model->fullName(),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Alumnos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sta.labels', 'Update');
?>
<div class="alumnos-update">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>