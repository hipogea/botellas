<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Contactos */

$this->title = Yii::t('app', 'Create Contactos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contactos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactos-create">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,'id'=>$id,
       //'vendorsForCombo'=>$vendorsForCombo,
       //'aditionalParams'=>$aditionalParams
    ]) ?>

</div>
    
    </div>
