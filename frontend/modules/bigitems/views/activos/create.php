<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\Activos */

$this->title = Yii::t('app', 'Create Activos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
