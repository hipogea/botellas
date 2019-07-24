    <label for="items" class="control-label">Items</label>
            <div class="table-responsive">
                <table class="table table-bordered" id="items">
                    <thead>
                        <tr style="background-color: #ddd;">
                               <th width="5%"  class="text-center">Acciones</th>
                                <th width="15%" class="text-left">Codigo</th>
                                <th width="80%" class="text-left">Codigo</th>
                        </tr>
                    </thead>
                    <tbody>
      
       <?php $orden=0;foreach($items as $item){ ?>
           <?php 
           
           echo $this->render('item',['auto'=>true,'form'=>$form,'item'=>$item,'orden'=>$orden]);
           $orden+=1;
           ?>
                   
       <?php } ?>
        <tr id="addItem">
           <td class="text-center"><button type="button" id="button-add-item" data-toggle="tooltip" title="Añadir" class="btn btn-xs btn-primary" data-original-title="Añadir"><i class="fa fa-plus"></i></button></td>
           <td class="text-right" colspan="2"></td>
       </tr>
          
        </tbody>                 
     </table>
            </div>
    <?php 
   $cadenaJs="$('#button-add-item').on( 'click', function() { 
    
            $.ajax({
              url: '". \yii\helpers\Url::to('ajax-add-item')."',
              type: 'POST',
             data: { model: '".str_replace('\\','_',get_class($item))."'  , orden: 4 },
              dataType: 'html',        
            
               error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(html) {
                   $('tbody #addItem').before(html);
                        }
                        });  "
            . "})";
       
  
   $this->registerJs($cadenaJs, \yii\web\View::POS_LOAD);
   ?>