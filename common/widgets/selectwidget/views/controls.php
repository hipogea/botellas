<?php 
use yii\helpers\Html;
?>
<?php
$options= ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                     'class'=>'probandoSelect2',
                      //'multiple'=>(!$multiple)?'multiple':false,
                     //'id'=> uniqid(),
                        ];
if($multiple){
    $options['multiple']='multiple';
    $options['data']=$datos;
}
?>
 <?= $form->field($model,$campo)->
            dropDownList($valoresLista,
                   $options
                    ) ?>
 




