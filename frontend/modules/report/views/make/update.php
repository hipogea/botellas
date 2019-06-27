<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\report\models\Reporte */

$this->title = Yii::t('report.messages', 'Update Reporte: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('report.messages', 'Reportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('report.messages', 'Update');
?>
<div class="reporte-update">
<div class="box box-success">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
            'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
    ]) ?>

</div>
    </div>
