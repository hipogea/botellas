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
<?= Html::button(yii::t('base.verbs','New Contact'), ['value' => Url::to(['masters/clipro/createcontact','id'=>$model->codpro]), 'title' => yii::t('base.verbs','New Contact'), 'id'=>'btn_contactos',/*'class' => 'showModalButton btn btn-success'*/]); ?>
  <?php $ruta=Url::toRoute(['masters/clipro/createcontact','id'=>$model->codpro]);   ?>
    <?php /*$this->registerJs("var vjs_url=".json_encode($ruta).";"
            . "var vjs_random=".json_encode(rand()).";",View::POS_HEAD); */ ?>
     <?php $this->registerJs("var vjs_url=".json_encode($ruta).";",View::POS_HEAD); ?>
      
   
   
   
<?php
use lo\widgets\modal\ModalAjax;

echo ModalAjax::widget([
    'id' => 'createCompany',
    'header' => 'Create Company',
    'toggleButton' => [
        'label' => 'New Company',
        'class' => 'btn btn-primary pull-right'
    ],
    'url' => Url::to(['/masters/clipro/createcontact','id'=>$model->codpro]), // Ajax view with form to load
    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
    //para que no se esconda la ventana cuando presionas una tecla fuera del marco
    'clientOptions' => ['tabindex'=>'',/*'backdrop' => 'static', 'keyboard' => FALSE*/]
    // ... any other yii2 bootstrap modal option you need
]);
 ?>  