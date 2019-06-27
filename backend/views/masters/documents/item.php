<?php  
//$form=new yii\widgets\ActiveForm();
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
?>
<tr id="item-"<?=$orden?>>
    <td class="text-center" style="vertical-align: middle;">
                <button type="button" onclick="$(this).tooltip('destroy'); $('#item-row-0').remove(); totalItem();" data-toggle="tooltip" title="Borrar" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
   </td>
   <td><?= $form->field($modelDetail,"[$orden]codparam")->label(false)->
        widget(Typeahead::classname(), [            
    'name' => 'country',
    'options' => ['placeholder' => 'Filter as you type ...'],
    'pluginOptions' => ['highlight'=>true],
    'dataset' => [
        [
            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
            'display' => 'value',
           // 'prefetch' => $baseUrl . '/documents/countries.json',
            'remote' => [
                'url' => Url::to(['masters/documents/listado']) . '?q=%QUERY',
                'wildcard' => '%QUERY'
            ]
        ]
    ],
            'pluginEvents' => [
   
    "typeahead:change" => "function() { alert('hola amigo'); }",
    
],
                                        ]);
        
        ; ?></td>               
   <td><?= $form->field($modelDetail,"[$orden]codocu")->label(false); ?>
    <?= $form->field($modelDetail, "[$orden]id")->hiddenInput(['value' => $modelDetail->id])->label(false);?>   
   </td> 
</tr>



