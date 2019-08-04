<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Carreras */

$this->title = Yii::t('base.names', 'Create Carreras');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Carreras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carreras-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>