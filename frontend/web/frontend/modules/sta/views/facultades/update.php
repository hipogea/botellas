<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Facultades */

$this->title = Yii::t('sta.labels', 'Update Facultades: {name}', [
    'name' => $model->codfac,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Facultades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codfac, 'url' => ['view', 'id' => $model->codfac]];
$this->params['breadcrumbs'][] = Yii::t('sta.labels', 'Update');
?>
<div class="facultades-update">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>