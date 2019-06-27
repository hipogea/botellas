   <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Documentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-form">
<?php  $form = ActiveForm::begin(['id' => 'report-form','options' => ['enctype' => 'multipart/form-data']]); ?>
<?=$this->render('cabecera',['form'=>$form,'model'=>$model])   ?>
<?php  

//var_dump($regalo);die();
//$cadena= serialize($form); 

?>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
            <?= $form->field($model, 'idreportedefault')->textInput() ?>
        </div>
    <br><br><br><br><br>
    <div class="form-actions">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    
 <?php  
 //var_dump($this->context);die();
 /*echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => yii::t('base.names','Items'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_detailparams',[ 'searchModel' => $searchModel, 'dataProvider' => $dataProvider,]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => true
        ],
       
    ],
]);  */  
    
    ?> 
    
    

      

</div>
<?php 
$orden=0;$cadena='1';
echo \yii\helpers\Html::script("
    
$(document).on('click', '#button-add-item', function (e) {
            $.ajax({
                url: '".\yii\helpers\Url::toRoute('masters/documents/additem')."',
                type: 'GET',
                dataType: 'JSON',
                data: {id: ".$cadena." },
                success: function(json) {
                      
                        $('#items tbody #addItem').before(json['html']);
                       
                        
                    
                }
            });
        });" ); ?>






