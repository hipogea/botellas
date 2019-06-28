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
            'attribute' => 'codum1',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '210px',
            
         ],
       
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'codum2',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '210px',
            
         ],
       
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'valor1',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '210px',
            
         ],
       
       [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'valor2',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '210px',
            
         ],
   ];
   echo grid::widget([
       'id'=>'holas',
       'bootstrap'=>true, 
       'bordered'=>false,
       'hover'=>true,
       'responsive'=>true,
       'tableOptions' =>['class' => 'table table-striped table-dark'],
    'dataProvider'=> $probConversiones,
   // 'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'responsive'=>true,
    'hover'=>true
       ]);
   ?>
   
   <div class ="table table-striped table-dark "
   
   

   
    <?php Pjax::end(); ?>
    <?php $url= Url::to(['/masters/materials/creaconversion','id'=>$model->codart,'gridName'=>'holas','idModal'=>'modal-conversiones']);
 
  echo  Html::button('Add Conversion', ['href' => $url, 'title' => 'Creating New Company', 'class' => 'botonAbre btn btn-success']); 

     ?>
