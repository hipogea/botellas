<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Centrosparametros */

$this->title = Yii::t('base.verbs', 'Create').' '. Yii::t('base.names', 'Parameter in Document');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Documents Parameters'), 'url' => ['indexparamdocu']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrosparametros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formparamdocu', [
        'model' => $model,
    ]) ?>

</div>
