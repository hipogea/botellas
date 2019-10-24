<?php
 use yii\helpers\Url;
 use yii\web\View;
?>
<div class="btn-group">
             <a id="link-carga" href="#" class="btn btn-warning btn-lg ">
                        <i class="glyphicon glyphicon-upload " aria-hidden="true"></i> <?=yii::t('sta.labels','Generar carga')?>
             </a>
             
             
     </div>
<div id="carga-temporal">
    
</div>
<?php 
  $this->registerJs("$('#link-carga').on( 'click', function() { 
      //alert(this.id);
      $.ajax({
              url: '".Url::toRoute(['ajax-create-upload'])."', 
              type: 'get',
              data:{id:".$model->id."},
              dataType: 'html', 
              error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(data) {  
                        $('#carga-temporal').html(data);
                        }
                        });
             })", View::POS_READY);
?>

