<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use kartik\grid\GridView as grid;
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

  
    <?php Pjax::begin(['id'=>'grilla-contactos']); ?>
   
   <?php 
   $gridColumns=[
       [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'nombres',
            'pageSummary' => 'Total',
            'editableOptions'=>[
                //'ajaxSettings'=>['data'=>['karina'=>'toledo']],
            ],
            'vAlign' => 'middle',
            'width' => '210px',
           //'data'=>['modelo'=>'mimodelo']
            
         ],
       [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'moviles',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '210px',
            
         ],
   ];
   echo grid::widget([
    'dataProvider'=> $dpContactos,
   // 'filterModel' => $searchModel,
       'summary' => '',
    'columns' => $gridColumns,
    'responsive'=>true,
    'hover'=>true
       ]);
   ?> 
   
    <?php Pjax::end(); ?>    
   
<?php
$url= Url::to(['/masters/clipro/createcontact','id'=>$model->codpro,'gridName'=>'grilla-contactos','idModal'=>'buscarvalor']);
 
  echo  Html::button(yii::t('base.verbs','Create'), ['href' => $url, 'title' => 'Nuevo Contacto de '.$model->despro,'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 

  
 /* use lo\widgets\modal\ModalAjax;

echo ModalAjax::widget([
    'id' => 'createCompany',
    'header' => 'Create Company',
    'toggleButton' => [
        'label' => 'New Company',
        'class' => 'btn btn-primary pull-right',
        'id'=>'mibotonmodal'
       // 'style'=>'visibility:hidden',
        
    ],
    'url' => $url, // Ajax view with form to load
    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
    //para que no se esconda la ventana cuando presionas una tecla fuera del marco
    'clientOptions' => ['tabindex'=>'','backdrop' => 'static', 'keyboard' => FALSE]
    // ... any other yii2 bootstrap modal option you need
]);*/
 ?>  
   
   <?php 
   //echo \yii\helpers\Html::a('pinchar', \yii\helpers\Url::toRoute(['/masters/clipro/createcontact','final'=>'si']), []);
  // $this->registerJs("$('#btn_prueba').on('click', function (ev) { $.pjax({container:'grilla-contactos'}); });",View::POS_HEAD); 
   //$this->registerJs("$('#btn_prueba').on('click',  alert('caramba'))",View::POS_READY); 
  // echo Html::button('Press me!', ['onClick' => "$('#mibotonmodal').click();"]) ;
   ?>