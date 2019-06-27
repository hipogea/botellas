<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Centrosparametros */

$this->title = Yii::t('base.verbs', 'Create {algo}',['algo'=>yii::t('base.names','Parameter')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app',yii::t('base.names','Parameter')), 'url' => ['indexmaster']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrosparametros-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_formmaster', [
        'model' => $model,
    ]) ?>

</div>
