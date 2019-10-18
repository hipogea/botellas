<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\sta\models\TalleresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('sta.labels', 'Alumnos Riesgo');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talleres-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
    
   
    <?php  echo $this->render('_searchriesgo', ['model' => $searchModel]); ?>

        <?php Pjax::begin(); ?> 
        
     <div class="box-body">
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            'id',
            'codfac',
            'codalu',
            'ap',
            'nomcur',
            //'fclose',
            //'codcur',
            //'activa',
            //'codperiodo',
            //'electivo',
            //'ciclo',          
        ],
    ]); ?>
    <?php Pjax::end(); ?>

    </div>
</div>
    </div>
       