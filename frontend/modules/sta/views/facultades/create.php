<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Facultades */

$this->title = Yii::t('base.names', 'Create Facultades');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Facultades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facultades-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>