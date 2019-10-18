<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Test */

$this->title = Yii::t('sta.labels', 'Update Test: {name}', [
    'name' => $model->codtest,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codtest, 'url' => ['view', 'id' => $model->codtest]];
$this->params['breadcrumbs'][] = Yii::t('sta.labels', 'Update');
?>
<div class="test-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
