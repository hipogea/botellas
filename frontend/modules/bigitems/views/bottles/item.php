<?php  
//$form=new yii\widgets\ActiveForm();
//use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use common\widgets\selectwidget\selectWidget;
?>

<tr id="item-detbotella-<?=$orden?>">
    <td class="text-center" style="vertical-align: middle;">
                <button type="button" onclick="$('#item-detbotella-<?=$orden?>').remove(); " data-toggle="tooltip" title="Borrar" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
   </td>
  <td><?= 
          selectWidget::widget([
              'id'=> strtolower($item->getShortNameClass().'-'.$orden.'-codigo'),
              'model'=>$item,
            'form'=>$form,
            'campo'=>"[$orden]codigo",
              'ordenCampo'=>5,
              'inputOptions'=>['labelOptions'=>['label'=>false]],
            // 'addCampos'=>[2,5],
          ]
         ) ?></td>               
   <td><?= $form->field($item,"[$orden]descripcion",['labelOptions'=>['label'=>false]]); ?>
    <?= $form->field($item, "[$orden]id")->hiddenInput(['value' => $item->id])->label(false);?>   
   </td> 
</tr>

<?php
   if(!$auto){
         $this->registerJs(" 
      
   var fieldAttributes = $('#tabular-botellas').yiiActiveForm('find', 'detdocbotellas-0-codigo');
$('#tabular-botellas').yiiActiveForm('add', {
    id: 'detdocbotellas-4-codigo',
    name: '[4][codigo]',
    container: '.field-detdocbotellas-4-codigo',
    input: '#detdocbotellas-4-codigo',
    error: '.help-block',
    enableAjaxValidation:true,
    validate:  fieldAttributes.validate
});




    ", static::POS_END);
         
   }
  
 ?>

