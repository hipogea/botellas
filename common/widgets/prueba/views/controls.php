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
$opciones=array_merge($opciones,$options);

?>
<?php ECHO \yii\helpers\Html::activeDropDownList(
        $model, 
        $campo,
        $valoresLista,
        $opciones);  ?>
 
 




