<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\bigitems\models\Docbotellas */

$this->title = Yii::t('bigitems.errors', 'Create Docbotellas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('bigitems.errors', 'Docbotellas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docbotellas-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_formtabs', [
       'model' => $model,'items'=>$items
    ]) ?>

</div>
</div>