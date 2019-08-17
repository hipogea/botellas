<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */

$this->title = Yii::t('base.actions', 'Update Clipro: {name}', [
    'name' => $model->despro,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Clipros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codpro, 'url' => ['view', 'id' => $model->codpro]];
$this->params['breadcrumbs'][] = Yii::t('base.verbs', 'Update');
?>
<div class="clipro-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_formfirme', [
        'model' => $model,
            'dpContactos' => $dpContactos,
            'dpDirecciones' => $dpDirecciones,
         'dpMaestroclipro' =>$dpMaestroclipro,
       'dpObjetosCliente' =>$dpObjetosCliente 
    ]) ?>

</div>
