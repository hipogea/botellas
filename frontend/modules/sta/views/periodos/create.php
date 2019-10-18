<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Periodos */

$this->title = Yii::t('bigitems.labels', 'Create Periodos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('bigitems.labels', 'Periodos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodos-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>