<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiBasePresupuesto */

$this->title = Yii::t('sigi.labels', 'Create Sigi Base Presupuesto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('sigi.labels', 'Sigi Base Presupuestos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sigi-base-presupuesto-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>