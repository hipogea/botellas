<?php ?>
<?php
$url=\yii\helpers\Url::toRoute('/finder/renderparam');
   $this->registerJs("$(document).ready(function() {
    $('#btn_param').on('click',function(){
  
  $.ajax({ 
   url:'".$url."',
   type:'get',
   dataType:'html',
   data:{codocu:'478'},
   error:  function(xhr, status, error){ 
                            var n = Noty('id');                      
                             $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ xhr.responseText);
                              $.noty.setType(n.options.id, 'error');         
                                }, 
success: function (data) {// success callback function
           $('#div-parametros').html(data);
    }
       }); //ajax 
        } //on change
    );//on change
     });",\yii\web\View::POS_END);
?>
<div >ESTA ES LA SOLAPA CONFIG</div>
<button id="btn_param" class="btn btn-success" >Parametros</button>
<div id="div-parametros"></div>



