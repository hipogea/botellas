<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\searchwidget\searchWidget;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Maestroclipro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maestroclipro-form">
  
    <?php $form = ActiveForm::begin(); ?>
       
     <?php echo searchWidget::widget([
           'id'=>'mipapaxx',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codpro',
            'foreignskeys'=>[1,2,3],
        ]);  ?>
    
    
     <?php /*echo \common\widgets\selectwidget\selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codpro',
            //'foreignskeys'=>[1,2,3],
        ]); */ ?>
    
    
    <?php
$url= \yii\helpers\Url::to(['/masters/clipro/solodialog','id'=>$model->codpro,'gridName'=>'grilla-contactos','idModal'=>'createCompany']);
    //echo  Html::button('Searggch', ['href' => $url, 'title' => 'Creating New Company', 'class' => 'showModalButton btn btn-success']); 
  //echo Html::button('Search', ['onClick'=>'$("#cru-frame3").attr("src","'.$url.'");   $("#midialogo").dialog("open");return false;',  'value' => $url,  'class' => 'btn btn-success']);
   ?>
    
    
    
<?php /*
use kartik\dialog\Dialog;
use yii\web\JsExpression;
echo Dialog::widget([
    'libName' => 'krajeeDialogCust2', // a custom lib name
    'options' => [  // customized BootstrapDialog options
        'size' => Dialog::SIZE_WIDE, // large dialog text
        'type' => Dialog::TYPE_INFO, // bootstrap contextual color
        'title' => 'My Dialog',
        'nl2br' => false,
        'buttons' => [
            [
                'id' => 'cust-submit-btn',
                'label' => 'Submit',
                'cssClass' => 'btn-primary',
                'hotkey' => 'S',
                'action' => new JsExpression("function(dialog) {
                    if (typeof dialog.getData('callback') === 'function' && dialog.getData('callback').call(this, true) === false) {
                        return false;
                    }
 
                    return dialog.close();
                }")
            ],
            [
                'id' => 'cust-cancel-btn',
                'label' => 'Cancel',
                'cssClass' => 'btn-outline-secondary',
                'hotkey' => 'C',
                'action' => new JsExpression("function(dialog) {
                    if (typeof dialog.getData('callback') === 'function' && dialog.getData('callback').call(this, false) === false) {
                        return false;
                    }
 
                    return dialog.close();
                }")
            ],
        ]
    ]
]);
 
// button markups for launching the custom krajee dialog box
echo '<hr><button type="button" id="btn-custom-2" class="btn btn-info">Custom Dialog 2</button>';
 
// javascript for triggering the dialogs
$js = '$("#btn-custom-2").on("click", function() {
      
       $("#plancha").attr("src","'.$url.'"); 
           cadenahtml=$("#plancha").contents().find("html").html();
           alert(cadenahtml);
           krajeeDialogCust2.dialog(
        cadenahtml, // markup stored in a hidden textarea
        function(result) {
            // do something
        }
    ); 
    
});'  ;

 
// register your javascript
$this->registerJs($js);
*/
?>
    
    
    
    
    
    
    
    
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'venta')->textInput(['maxlength' => true]) ?>
    </div>
    
    
    <?php echo searchWidget::widget([
           'id'=>'mipapaxx',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codart',
            'foreignskeys'=>[4,2,3],
        ]);  ?>
         
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'vencimiento')->textInput() ?>

              
              </div>
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'tiempoentrega')->textInput() ?>
     </div>
   <?php echo searchWidget::widget([
            'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codcen',
            'foreignskeys'=>[1,2,3],
        ]);  ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'precio')->textInput() ?>
             </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'codmon')->textInput(['maxlength' => true]) ?>
     </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'param1')->textInput(['maxlength' => true]) ?>
  </div>
    <?= $form->field($model, 'param2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'param3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'param4')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
//use yii\jui\Dialog;
\yii\jui\Dialog::begin([
    'id'=>'nuevomodal',
    'clientOptions' => [
        'fluid'=>true,
        'autoOpen'=>false,
       // 'modal' => true,
         'width'=>'auto', // overcomes width:'auto' and maxWidth bug
    'maxWidth'=>600,
    'height'=>'auto',
    'modal'=>true,    
    'resizable'=>false
    ],
]);
?>
<iframe  id="plancha" style="padding:0px;margin:0px;border:none;height:100%; width:100%;"></iframe>
<?php
\yii\jui\Dialog::end();
?>


<?php
echo '<hr><button type="button" id="btn-custom-3">Custom Dialog 3</button>';
 
// javascript for triggering the dialogs
$js = '$("#btn-custom-3").on("click", function() {
     
       $("#plancha").attr("src","'.$url.'"); 
          $("#nuevomodal").dialog("open");   
    
});'  ;


// register your javascript
$this->registerJs($js);

?>