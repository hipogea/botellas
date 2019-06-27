<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Documentos */

$this->title = Yii::t('app', 'Create Documentos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-create">
 
    <h6><?= Html::encode($this->title) ?></h6>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
         //'searchModel' => $searchModel,
          //'dataProvider' => $dataProvider,
    ]) ?>

</div>
</div>