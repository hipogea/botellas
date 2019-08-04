<?php 
use yii\helpers\Html;
?>
<div class="cuadrazo">
<div class="img-thumbnail cuaizquierdo">
   <?= Html::img($urlImage,[
    'width'=>$ancho,
      'height'=>$alto,  
]) ?> 
</div>
   <div class=" cuaderecho">
     <?php if(!$isNew) {  ?>
       <div class="absolute"><?=$numeroImages?></div>
     <?php 
        $url=$urlModal;
 
        echo  Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['href' => $url, 'title' => 'Edit image', 'class' => 'botonAbre btn btn-success']); 
        ?>
       
       <span class="btn btn-warning btn-gh glyphicon glyphicon-zoom-in"></span>
     <?php }else{  ?>
       <span class="glyphicon glyphicon-alert"></span>
       <?=$mensaje?>
 <?php }  ?>
   </div> 
</div>





