<div style="position:absolute;
     width:280px;height:80px;
     padding:0px; top:<?php echo $model->ylogo-1; ?>px;
     left:<?php echo $model->xlogo-1; ?>px; border-style:solid; border-width:1px; border-color:#e1e1e1 ">
</div>

<div style="position:absolute; padding:1px;border-style:none; 
     top:<?php echo $model->ylogo; ?>px; left:<?php echo $model->xlogo; ?>px; ">
    				<div style="float:left">
	<?php echo \yii\helpers\Html::img($model->files[0]->getUrl(), ['width'=>100,'height'=>70]); ?>
				</div>

</div>
<div style="position:absolute;  padding:0px; float:left; left:<?php echo ($model->xlogo+100); ?>px; top:<?php echo ($model->ylogo+10); ?>px;">

							<span style="font-family:cour; font-size:10px !important;">
								<?php echo $modelosociedad->dsocio; ?>
							</span>
	<div  >
							<span style="font-family:courier; font-size:7px !important;">
								<?php echo $modelosociedad->direccionfiscal; ?>
							</span>
	</div>
	
	<div >
							<span style="font-family:courier; font-size:7px !important;">
								<?php  echo $modelosociedad->getAttributeLabel('telefonos')." : ".$modelosociedad->telefonos;  ?>
							</span>
	</div>
	<div >
							<span style="font-family:courier; font-size:7px !important;">
								<?php  echo $modelosociedad->getAttributeLabel('mail')." : ".$modelosociedad->mail."    ".$modelosociedad->web; ?>
							</span>
	</div>
</div>



