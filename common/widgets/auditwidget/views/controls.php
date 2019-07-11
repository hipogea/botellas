<?php 
use yii\helpers\Html;
use yii\jui\Dialog;
//use yii\helpers\Html;
?>
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
  <div style="float:left;width: 70%;">
<?=$form->field($model, $campo)->textInput(['maxlength' => true]); 
 ?>
      </div>
      <div style="float: left;width:30%;padding-top: 25px;">
          <button type="button" id="btn-<?=$idcontrolprefix?>" class="btn btn-info"><i class="fa fa-search"></i></button>
 </div>
      </div>
<?php
foreach($valores as $nombrecampo=>$arraycampo){
    ?>
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 form-group">   
         <?= Html::label($arraycampo['label'],null,['class'=>'control-label']) ?>   
         <?= Html::textInput("adicional-".$nombrecampo,$arraycampo['value'],['class'=>'form-control','disabled'=>'disabled','id'=>'adicional-'.$nombrecampo,'maxlength' => true]) ?>
    </div>


<?php }
?>
<br>
<?php
Dialog::begin([
    'id'=>'modal-'.$idcontrolprefix,
    'clientOptions' => [
        'fluid'=>true,
        'autoOpen'=>false,
       // 'modal' => true,
         'width'=>'auto', // overcomes width:'auto' and maxWidth bug
   // 'maxWidth'=>600,
    //'height'=>'auto',
    'modal'=>true,    
    //'resizable'=>false
    ],
]);
?>
<iframe  id="iframe-<?=$idcontrolprefix?>" style="padding:0px;margin:0px;border:none;height:100%; width:100%;"></iframe>
<?php
Dialog::end();
?>


<?php

$scriptJx=' $(window).resize(function () {
    fluidDialog();
});

// catch dialog if opened within a viewport smaller than the dialog width
$(document).on("dialogopen", ".ui-dialog", function (event, ui) {
    fluidDialog();
});

function fluidDialog() {
    var $visible = $(".ui-dialog:visible");
    // each open dialog
    $visible.each(function () {
        var $this = $(this);
        var dialog = $this.find(".ui-dialog-modal-'.$idcontrolprefix.'").data("dialog");
        // if fluid option == true
        if (dialog.options.fluid) {
            var wWidth = $(window).width();
            // check window width against dialog width
            if (wWidth < dialog.options.maxWidth + 50) {
                // keep dialog from filling entire screen
                $this.css("max-width", "90%");
            } else {
                // fix maxWidth bug
                $this.css("max-width", dialog.options.maxWidth);
            }
            //reposition dialog
            dialog.option("position", dialog.options.position);
        }
    });

}';
$this->registerJs($scriptJx);
?>