<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\CliproSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="box box-success">
<div class="clipro-index">

    <h4><?= Html::encode($this->title) ?></h4>
    
    <?php Pjax::begin(); ?>
    
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?PHP
    //var_dump($campoclave);die();
    //$columnClave=['codpro'=>['clave1'=>'uno', 'clave2'=>'dos']];
    //$camposAdicionales=['despro','rucpro','telpro'];
   // print_r(array_merge($columnClave, $camposAdicionales)); die();
    ?>
    
    
 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          [
            'label' => 'codigo',
            'format' => 'raw',
            'attribute' => 'codart',
            'value' => function ($data,$campoclave) {
                return Html::a($campoclave,Url::toRoute(['finder/busquedamodal','nombrecontrol'=>\common\helpers\h::request()->get('nombrecontrol'),'cierra'=>'si','valor'=>$campoclave]), ['id'=>'link_'.$campoclave]);
            },
           ], 
            $camposAdicionales[0],
            $camposAdicionales[1],        
            $camposAdicionales[2],
            //'deslarga:ntext',
        ],
    ]); ?>
    
  
    <?php Pjax::end(); ?>
    
</div>   
   
   
   <?php
   $jsd='$(document).ready(function(){
  $("[hreffff]").click(function(e){
  $("#modal-'.$nombrecontrol.'").dialog("close");
  $("#iframe-'.$nombrecontrol.'").attr("src",""); 
   valor= e.target.id;
   valor=valor.substring(5,100);
  alert(valor);  
   window.parent.$("#'.$nombrecontrol.'").val(valor).trigger("change");
  });

});';
   
   $this->registerJs($jsd);
   ?>
    
</div>
<?php
echo '<hr><button type="button" id="btn-custom-x">cerarar dailogo</button>';

   $jsdx='$(document).ready(function(){
  $("#btn-custom-x").click(function(){
  alert("presiono");
  $("#iframe-maestroclipro-codpro").attr("src","");
  window.parent.$("#modal-maestroclipro-codpro").dialog("close");
    });
});';
   
   $this->registerJs($jsdx);
   ?>
    
