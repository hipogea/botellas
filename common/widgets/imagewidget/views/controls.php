<?php 
use yii\helpers\Html;
?>
<?php
$options= ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                     //'class'=>'probandoSelect2',
                      //'multiple'=>(!$multiple)?'multiple':false,
                     //'id'=> uniqid(),
                        ];

?>
 <?= $form->field($model,$campo)->
            dropDownList($data,
                   $options
                    ) ?>
 




