<?php 
use yii\helpers\Html;
?>

 <?= $form->field($model,$campo)->
            dropDownList($valoresLista,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                     'class'=>'probandoSelect2',
                        ]
                    ) ?>
 




