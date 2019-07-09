<?php  
//$form=new yii\widgets\ActiveForm();
//use kartik\typeahead\Typeahead;
use yii\helpers\Url;
?>
<tr id="item-detbotella-<?=$orden?>">
    <td class="text-center" style="vertical-align: middle;">
                <button type="button" onclick="$('#item-detbotella-<?=$orden?>').remove(); " data-toggle="tooltip" title="Borrar" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
   </td>
   <td><?= $form->field($item,"[$orden]codigo",['enableAjaxValidation' => true,'options'=>['aria-invalid'=>'true']])->label(false);?></td>               
   <td><?= $form->field($item,"[$orden]descripcion")->label(false); ?>
    <?= $form->field($item, "[$orden]id")->hiddenInput(['value' => $item->id])->label(false);?>   
   </td> 
</tr>



