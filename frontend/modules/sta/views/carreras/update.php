<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Carreras */

$this->title = Yii::t('base.names', 'Update Carreras: {name}', [
    'name' => $model->codcar,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Carreras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codcar, 'url' => ['view', 'id' => $model->codcar]];
$this->params['breadcrumbs'][] = Yii::t('base.names', 'Update');
?>
<div class="carreras-update">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>