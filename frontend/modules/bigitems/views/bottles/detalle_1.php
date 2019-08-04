<?PHP 

use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use unclead\multipleinput\TabularColumn;
use common\widgets\prueba\pruebaWidget;
?>
<?= TabularInput::widget([
    'id'=>'wtabularbotellas',
    'models' => $items,
   // 'modelClass' => Item::class,
    'cloneButton' => true,
    'sortable' => true,
    'min' => 0,
    'addButtonPosition' => [
        TabularInput::POS_HEADER,
        TabularInput::POS_FOOTER,
        TabularInput::POS_ROW
    ],
    'layoutConfig' => [
        'offsetClass'   => 'col-sm-offset-4',
        'labelClass'    => 'col-sm-2',
        'wrapperClass'  => 'col-sm-10',
        'errorClass'    => 'col-sm-4'
    ],
    'attributeOptions' => [
        'enableAjaxValidation'   => true,
        'enableClientValidation' => false,
        'validateOnChange'       => false,
        'validateOnSubmit'       => true,
        'validateOnBlur'         => false,
    ],
    'form' => $form,
    'columns' => [
       [
            'name' => 'coditem',
            'title' => 'Item',
            'type' => TabularColumn::TYPE_TEXT_INPUT,
            'attributeOptions' => [
                'maxlength' => 3,
                'validateOnChange' => true,
            ],
            
            'enableError' => true
        ],
        
        
        
       ['name'  => 'codigo',
            'title' => 'CODIGO',
         'type'  =>pruebaWidget::className(),/*kartik\date\DatePicker::className(),*//*pruebaWidget::className(),*/
    //'type'  =>kartik\select2\Select2::className(),
           /* 'options'=>[
             'id'=> uniqid(),
           // 'tabular'=>true,
           // 'id'=>'mipapa',
            'model'=>$items[0],
            'form'=>$form,
            'attribute'=>'codigo',
            'campo'=>'codigo',
            'ordenCampo'=>5,
             'inputOptions'=>['labelOptions'=>['label'=>false]],
            //'foreignskeys'=>[1,2,3],
                              ],*/
        'enableError' => true,
            ],
        [
            'name' => 'tarifa',
            'title' => 'Tarifa',
            'type' => TabularColumn::TYPE_TEXT_INPUT,
            'attributeOptions' => [
                'enableClientValidation' => true,
                'validateOnChange' => true,
            ],
            
            'enableError' => true
        ],
        [
            'name' => 'id',
            'title' => 'id',
            'type' => TabularColumn::TYPE_HIDDEN_INPUT,
            'enableError' => false
        ],
        
    ],
]) ?>    


<script>
    jQuery('#wtabularbotellas').on('beforeDeleteRow',
    function(e, row, currentIndex) {
           alert(currentIndex);
   
        });
</script>