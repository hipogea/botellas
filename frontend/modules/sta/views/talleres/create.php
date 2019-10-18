<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */

$this->title = Yii::t('sta.labels', 'Create Talleres');
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Talleres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talleres-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>