<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\ImportCargamasiva */

$this->title = Yii::t('import.labels', 'Update Import Cargamasiva: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('import.labels', 'Import Cargamasivas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('import.labels', 'Update');
?>
<div class="import-cargamasiva-update">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,'itemsFields'=> $itemsFields,
            'itemsLoads'=> $itemsLoads,
    ]) ?>

</div>
</div>