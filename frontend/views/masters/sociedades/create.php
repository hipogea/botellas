<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sociedades */

$this->title = Yii::t('control.errors', 'Create Sociedades');
$this->params['breadcrumbs'][] = ['label' => Yii::t('control.errors', 'Sociedades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sociedades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
