<?php use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>


    
   

    <?php Pjax::begin(['id'=>'grilla-rangos']); ?>
   
    <?php 
    //var_dump($dataProviderRangos->getCount());die();
    echo "hola";
   
    echo GridView::widget([
        'dataProvider' => $dataProviderRangos,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            'dia',
             'nombredia',
             'tolerancia',
            'hinicio',
             'hfin',
          
        ],
    ]); ?>
    <?php Pjax::end(); ?>


  
       
<?php
 $url= Url::to(['agrega-psico','id'=>$model->id,'gridName'=>'grilla-staff','idModal'=>'buscarvalor']);
   echo  Html::button(yii::t('base.verbs','Create'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
?> 
