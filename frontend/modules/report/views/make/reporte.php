<?php
//definiendo el marco de referncia absoluto de la hoja
//con margenes 0 y 0
//$cadenaestilo='position: fixed;  top: '.$modelo->ygeneral.'px; left:'.$modelo->xgeneral.'px; width:3px; height:3px; border: 0px;';
?>
<?php
//Cerrar el margen absoluto
//echo CHtml::openTag("div",array('style'=>$cadenaestilo));
?>

<?php

  if($modelo->tienelogo){
    //echo $this->renderLogo($modelo->sociedad,$modelo->id,$modelo->xlogo,$modelo->ylogo);
  }

?>

<?php
//echo  $this->cabecera($filamuestracabecera,$proveedorestilo);
echo $cabecera;

					   //'columnas'=>$this->makeColumnas($filamuestrahijo,$proveedordatos),
?>


<div style="position:absolute; left:<?php echo '0'; ?>px; top:<?php echo $modelo->y_grilla-40; ?>px">
  <?php // print_r($columnas);yii::app()->end();   ?>
<?php //echo CHtml::tag ( "hr",array ( "width"=>"90%"),false,true);?>
</div>

<div style="position:absolute; width:80%; left:<?php echo $modelo->x_grilla; ?>px; top:<?php echo $modelo->y_grilla; ?>px">
<?php // echo $hojaestilo; yii::app()->end();
//var_dump($modelo->tienecabecera);
// ?>
  <?php /* $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'detalle-grid',
    'hideHeader'=>($modelo->tienecabecera=='1')?FALSE:TRUE,
    'dataProvider'=>$proveedordatos,
      'enablePagination'=>'false',

    //'filter'=>$modelo,
    'summaryText'=>'',
   'cssFile' => $hojaestilo,
    'columns'=>$columnas,
    ));
*/
   // echo CHtml::openTag("span",array("encode"=>false,"style"=>"font-size:10px;")).str_repeat('*',150).CHtml::closeTag('span');
  ?>

</div>

<?php
//Cerrar el margen absoluto
//echo CHtml::closeTag("div");
?>


