<?php  use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use common\widgets\selectwidget\selectWidget;
?>
<?= TabularInput::widget([
    'models' => $items,
    'attributeOptions' => [
       'enableAjaxValidation'      => true,
        'enableClientValidation'    => false,
        'validateOnChange'          => false,
        'validateOnSubmit'          => true,
        'validateOnBlur'            => false,
    ],
    'columns' => [
        [
            'name'  => 'tarifa',
            'title' => 'tarifa',
            'type'  => \unclead\multipleinput\MultipleInputColumn::TYPE_TEXT_INPUT,
       'enableError' => true,
            ],
            ['name'  => 'codigo',
            'title' => 'CODIGO',
            'type'  =>selectWidget::className(),
        'options'=>[
            'tabular'=>true,
           // 'id'=>'mipapa',
          // 'model'=>$data,
            'form'=>$form,
            'campo'=>'codigo',
            'ordenCampo'=>5,
            //'foreignskeys'=>[1,2,3],
                              ],
        'enableError' => true,
            ],
        
    ],
]) ?>