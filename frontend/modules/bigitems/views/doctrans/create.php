<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\Guia */

$this->title = Yii::t('bigitems.labels', 'Create Guia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('bigitems.labels', 'Guias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>