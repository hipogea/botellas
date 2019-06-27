<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SociedadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('control.errors', 'Sociedades');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sociedades-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('control.errors', 'Create Sociedades'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'socio',
            'dsocio',
            'rucsoc',
            'activo',
            'direccionfiscal',
            //'telefonos',
            //'web',
            //'mail',
            //'regimentributario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
