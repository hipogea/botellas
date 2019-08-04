<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Aulas */

$this->title = Yii::t('base.names', 'Update Aulas: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Aulas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base.names', 'Update');
?>
<div class="aulas-update">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>