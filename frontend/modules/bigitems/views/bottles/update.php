<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\Docbotellas */

$this->title = Yii::t('bigitems.errors', 'Update Docbotellas: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('bigitems.errors', 'Docbotellas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('bigitems.errors', 'Update');
?>
<div class="docbotellas-update">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,'items'=>$items
    ]) ?>

</div>
</div>