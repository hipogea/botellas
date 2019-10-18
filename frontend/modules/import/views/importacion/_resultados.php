<?php use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
?>
<div style='overflow:auto;'> 
    
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   Errores
   <span class="badge badge-danger">Danger</span>
 </div>
  
    
   
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
  Aciertos <div class="badge badge-warning">0</div>
 </div>
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
  Tiempo de carga <div class="badge badge-warning">0</div>
 </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
  N líneas del archivo <div class="badge badge-warning">0</div>
 </div>
    
    
    
    
</div>