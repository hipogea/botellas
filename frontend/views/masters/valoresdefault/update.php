<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Valoresdefault */

$this->title = Yii::t('base.names', 'Update Valoresdefault: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Valoresdefaults'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base.names', 'Update');
?>
<div class="valoresdefault-update">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,'campos'=>$campos
    ]) ?>

</div>
</div>