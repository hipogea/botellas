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
      
       <?php //$orden=1; ?>
       <?php echo $this->render('item',['form'=>$form,'modelDetail'=>$modelDetail,'orden'=>$orden]); ?>
       <tr id="addItem">
           <td class="text-center"><button type="button" id="button-add-item" data-toggle="tooltip" title="Añadir" class="btn btn-xs btn-primary" data-original-title="Añadir"><i class="fa fa-plus"></i></button></td>
           <td class="text-right" colspan="2"></td>
       </tr>
          
        </tbody>                 
     </table>
            </div>