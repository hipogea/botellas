<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Facultades */

$this->title = Yii::t('sta.labels', 'Crear Facultad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Facultades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facultades-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>