<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Maestrocompo */

$this->title = Yii::t('base.verbs', 'Create').' '.Yii::t('base.names', 'Material');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maestrocompo-create">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
