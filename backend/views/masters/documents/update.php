<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Documentos */

$this->title = Yii::t('app', 'Update Documentos: {name}', [
    'name' => $model->codocu,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codocu, 'url' => ['view', 'id' => $model->codocu]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="documentos-update">
 <div class="box box-success">
    <h6><?= Html::encode($this->title) ?></h6>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
    ]) ?>

</div>
</div>