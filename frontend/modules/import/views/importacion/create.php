<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\ImportCargamasiva */

$this->title = Yii::t('import.labels', 'Create Import Cargamasiva');
$this->params['breadcrumbs'][] = ['label' => Yii::t('import.labels', 'Import Cargamasivas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="import-cargamasiva-create">

    <h4><?= Html::encode($this->title) ?></h4>

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


    
</div>