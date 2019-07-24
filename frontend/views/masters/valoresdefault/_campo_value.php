<?php
use common\widgets\selectwidget\selectWidget;
?>
<?=
selectWidget::widget([
                         // 'id'=>'mipapa',
                            'model'=>$table,
                            'form'=> new \yii\widgets\ActiveForm,
                            'campo'=>$campo,
                            'ordenCampo'=>2
                                 //'foreignskeys'=>[1,2,3],
                            ]) 
?>