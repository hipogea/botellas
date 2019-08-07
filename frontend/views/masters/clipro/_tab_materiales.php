<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
use yii\web\View;
  use common\models\masters\Clipro;
use common\models\masters\Direcciones;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */
/* @var $form yii\widgets\ActiveForm */
?>

   <h6><?= Html::encode($this->title) ?></h6>
    <?php Pjax::begin(); ?>
   
    <?= GridView::widget([
        'dataProvider' => $dpMaestroclipro,
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'codart',
            'maestrocompo.descripcion',
            'vencimiento',
            'precio',
            'codmon',
            //'ppt',
            //'pasaporte',
            //'codpuesto',
            //'cumple',
            //'fecingreso',
            //'domicilio',
            //'telfijo',
            //'telmoviles',
            //'referencia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?> 
 <?php $ruta=Url::toRoute(['masters/clipro/createcontact','id'=>$model->codpro]);   ?>
    <?php /*$this->registerJs("var vjs_url=".json_encode($ruta).";"
            . "var vjs_random=".json_encode(rand()).";",View::POS_HEAD); */ ?>
     
   
