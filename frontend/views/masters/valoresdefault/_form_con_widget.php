<?php
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\models\masters\Documentos;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Valoresdefault */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php    
    $form = ActiveForm::begin([
    'enableAjaxValidation'=> true
]); ?>

     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
         
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'controllerName'=>'masters/valoresdefault',
                'actionName'=>'ajax-fill-fields',
               'data'=> ComboHelper::getCboDocuments(),
               'campo'=>'codocu',
               'idcombodep'=>'valoresdefault-nombrecampo',             
                   'source'=> [],
                    ]       
               
               
        )  ?>
 </div> 
 
   <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">    
 <?= $form->field($model, 'nombrecampo')->
            dropDownList(($model->isNewRecord)?[]:$campos,
                  ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>
    
    
    
    
   
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
 <?= $form->field($model, 'activo')->checkBox() ?>
 </div> 


 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
     
        
         <?php 
         //var_dump($data);die();
         echo $this->render('_campo_value_para_update',
                            [
                        'table'=>$modeltabla,
                         'campo'=>$model->nombrecampo,
                     // 'modeloPadre'=>$model,
                               // 'data'=>$data,
                                'ordenCampo'=>$ordenCampo,
                                'campos'=>$campos
                                
                    ]).Html::activeHiddenInput($model, 'aliascampo',['value'=>$model->getAttributeLabel($model->nombrecampo)]);
                          ?>
        
     

 </div>   



 
 <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



<?php
    $cadenaJs="$('#valoresdefault-nombrecampo').on( 'change', function() { 
        valordocu=$('#valoresdefault-codocu').val();
        valorcampo=$('#valoresdefault-nombrecampo').val();
            $.ajax({
              url: '".\yii\helpers\Url::to('ajax-proposal-values')."',
              type: 'POST',
              data:{filtro:valordocu,campo:valorcampo} ,
              dataType: 'json', 
               error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(json) {
                       
                       if ( typeof json['error']==='undefined' ) {
                                if(json['html'] !== '')
                                $('#insertar_aqui').html(json['html']);
                            }                   
                        }
                        });  "
            . "})";
   $this->registerJs($cadenaJs);   
?>