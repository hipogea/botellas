<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\config\Configuracion */

$this->title = Yii::t('control.errors', 'Create Configuracion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('control.errors', 'Configuracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuracion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
