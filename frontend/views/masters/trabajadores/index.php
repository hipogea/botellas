<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\TrabajadoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base.actions', 'Trabajadores');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if (Yii::$app->session->hasFlash('info')): ?>
    <div class="alert alert-warning">
         
         <?= Yii::$app->session->getFlash('info') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
         
         <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
         
         <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>


<div class="trabajadores-index">

    <h4><?= Html::encode($this->title) ?></h4>
 <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('base.actions', 'Create Worker'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'summary' => '',
        'columns' => [
           

            'codigotra',
            'ap',
            'am',
            'nombres',
            'dni',            
            //'ppt',
            //'pasaporte',
            //'codpuesto',
            //'cumple',
            'fecingreso',
            //'domicilio',
            //'telfijo',
            //'telmoviles',
            //'referencia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
     </div>
</div>