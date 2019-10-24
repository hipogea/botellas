<?php
use yii\widgets\DetailView;
use yii\helpers\Url;
?>
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'descripcion',
            'fechacarga',
            'current_linea',
            'tienecabecera',
            //'codperiodo',
            //'codalu',
        ],
    ]) ?>

<div class="btn-group">
            
             <a id="link-gestionar" href="<?=Url::to(['resolve-upload','id'=>$identrega])?>" class="btn btn-info btn-lg ">
                        <i class="glyphicon glyphicon-arrow-right " aria-hidden="true"></i> <?=yii::t('sta.labels','Gestionar carga')?>
             </a>
             <a id="link-probar" href="#" class="btn btn-warning btn-lg ">
                        <i class="glyphicon glyphicon-check " aria-hidden="true"></i> <?=yii::t('sta.labels','Probar')?>
             </a>
            <a id="link-cargar" href="#" class="btn btn-success btn-lg ">
                        <i class="glyphicon glyphicon-play " aria-hidden="true"></i> <?=yii::t('sta.labels','Cargar')?>
             </a>
     </div>
<div id="resultados-carga-ajax">
    
</div>
<?php 
  $this->registerJs("$('#link-probar').on( 'click', function() { 
     // alert(this.id);
      $.ajax({
              url: '".Url::to(['/import/importacion/import'])."', 
              type: 'get',
              data:{id:".$model->id.",verdadero:0},
              dataType: 'html', 
              error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(data) {
              $('#resultados-carga-ajax').html(data);
                   
                        }
                        });


             })", \yii\web\View::POS_READY);
?>

<?php 
  $this->registerJs("$('#link-cargar').on( 'click', function() { 
     // alert(this.id);
      $.ajax({
              url: '".Url::to(['/import/importacion/import'])."', 
              type: 'get',
              data:{id:".$model->id.",verdadero:1},
              dataType: 'html', 
              error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(data) {
              $('#resultados-carga-ajax').html(data);
                   
                        }
                        });


             })", \yii\web\View::POS_READY);
?>