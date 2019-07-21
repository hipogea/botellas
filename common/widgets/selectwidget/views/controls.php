<?php 
use yii\helpers\Html;
?>
<?php
$options= ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
           'class'=>'probandoSelect2',
          // 'labelOptions'=>['label'=>false],
                      
                        ];
if($multiple){
    $options['multiple']='multiple';
    $options['data']=$datos;
}


?>
 <?= $form->field($model,(is_null($orden))?$campo:'['.$orden.']'.$campo,$opciones)->
            dropDownList($valoresLista,
                   $options
                    ) ?>
 




