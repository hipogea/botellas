<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Ums */

$this->title = Yii::t('base.verbs', 'Update {name}', [
    'name' => $model->desum,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codum, 'url' => ['view', 'id' => $model->codum]];
$this->params['breadcrumbs'][] = Yii::t('base.verbs', 'Update');
?>
<div class="ums-update">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
