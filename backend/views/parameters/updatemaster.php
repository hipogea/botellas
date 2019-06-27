<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Centrosparametros */

$this->title = yii::t('base.verbs','Update').Yii::t('base.verbs', ' {algo}: {name}', [
    'name' => $model->codparam,'algo' => yii::t('base.names','Parameter'),
]);
$this->params['breadcrumbs'][] = ['label' => yii::t('base.names','Parameter'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codparam, 'url' => ['view', 'id' => $model->codparam]];
$this->params['breadcrumbs'][] = Yii::t('base.verbs', 'Update');
?>
<div class="centrosparametros-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_formmaster', [
        'model' => $model,
    ]) ?>

</div>
