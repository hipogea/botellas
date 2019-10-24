<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;
use frontend\modules\sta\helpers\comboHelper;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Aulas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.names', 'Aulas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="aulas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('base.names', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base.names', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base.names', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php 
echo DetailView::widget([
    'formOptions' => [
        'id' => 'aulas-form',
    'enableAjaxValidation' => true,
    'fieldClass' => 'common\components\MyActiveField',
       'action' => Url::to(['view','id'=>$model->id]),
    ] ,// your action to delete
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>yii::t('base.names','Aula' ).'  '. $model->codaula,
        'type'=>DetailView::TYPE_WARNING,
    ],
    'attributes'=>[
        'codaula',
            ['attribute'=>'codfac',
                'type'=>DetailView::INPUT_SELECT2,
                'widgetOptions'=>[
                    'data'=> comboHelper::getCboFacultades(),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
        ],            
            'cap',
    ]
]);
  ?>  

</div>
