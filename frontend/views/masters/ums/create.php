<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Ums */

$this->title =Yii::t('base.verbs', 'Create').' '.Yii::t('base.names', 'Units of measure');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
<div class="ums-create">
   <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>