<?php 
use yii\helpers\Html;
?>
<?php
if(!array_key_exists('prompt', $inputOptions))
$inputOptions['prompt']= '--'.yii::t('base.verbs','Seleccione un Valor')."--";

?>
 <?= $form->field($model,$campo)->
            dropDownList($data,
                   $inputOptions
                    ) ?>
 




