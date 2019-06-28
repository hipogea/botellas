<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Direcciones */

$this->title = Yii::t('base.names', 'Create Direcciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Direcciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direcciones-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>