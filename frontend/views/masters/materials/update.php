<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Maestrocompo */

$this->title = Yii::t('base.names', 'Update Maestrocompo: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Maestrocompos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base.names', 'Update');
?>
<div class="maestrocompo-update">
<div class="box box-success">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formfirme', [
        'model'=>$model,
        'probConversiones'=>$probConversiones
            ]) ?>

</div>
    </div>
