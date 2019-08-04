<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Aulas */

$this->title = Yii::t('base.names', 'Create Aulas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Aulas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aulas-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>