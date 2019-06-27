<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Maestroclipro */

$this->title = Yii::t('base.names', 'Create Maestroclipro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Maestroclipros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maestroclipro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
