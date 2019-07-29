<?php
use common\widgets\prueba\pruebaWidget;
?>
<?=
pruebaWidget::widget([
                         // 'id'=>'mipapa',
                            'model'=>$table,
                            //'form'=> new \yii\widgets\ActiveForm,
                            'attribute'=>$campo,
                            'ordenCampo'=>$ordenCampo,
                            /*'data'=>$data,*/
                                 //'foreignskeys'=>[1,2,3],
                            ]) 
?>