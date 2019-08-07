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


     <?php Pjax::begin(['id'=>'grilla-objetos']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     <?php
   $gridColumns=[
       'codigo',
       [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'descripcion',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '210px',
            'readonly' => false,
           //'data'=>['modelo'=>'mimodelo']
            
         ],
       
   ];
   echo grid::widget([
    'dataProvider'=> $dpObjetosCliente,
   // 'filterModel' => $searchModel,
    'columns' => $gridColumns,
       'summary'=>'',
    'responsive'=>true,
    'hover'=>true
       ]);
   ?>
   
   
   
   

   
    <?php Pjax::end(); ?>

  <?php $url=Url::toRoute(['masters/clipro/create-object','id'=>$model->codpro]);   ?>
   <?php  echo  Html::button(yii::t('base.verbs','Create'), ['href' => $url, 'title' => 'Nuevo Objeto de '.$model->despro,'id'=>'btn_objects', 'class' => 'botonAbre btn btn-success']); ?>
      <?php /*$this->registerJs("var vjs_url=".json_encode($ruta).";"
            . "var vjs_random=".json_encode(rand()).";",View::POS_HEAD); */ ?>
     
   