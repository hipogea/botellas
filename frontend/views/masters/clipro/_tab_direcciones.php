<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
use kartik\grid\GridView as grid;
  use common\models\masters\Clipro;
use common\models\masters\Direcciones;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */
/* @var $form yii\widgets\ActiveForm */
?>

   <h6><?= Html::encode($this->title) ?></h6>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     <?php
   $gridColumns=[
       [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'direc',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '210px',
           //'data'=>['modelo'=>'mimodelo']
            
         ],
       [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'nomlug',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '210px',
            
         ],
   ];
   echo grid::widget([
    'dataProvider'=> $dpDirecciones,
   // 'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'responsive'=>true,
    'hover'=>true
       ]);
   ?>
   
   
   
   

   
    <?php Pjax::end(); ?>
