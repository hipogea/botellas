<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */

$this->title = Yii::t('app', 'Create Combovalores');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Combovalores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="combovalores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
