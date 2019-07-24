<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Valoresdefault */

$this->title = Yii::t('base.names', 'Create Valoresdefault');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Valoresdefaults'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valoresdefault-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>