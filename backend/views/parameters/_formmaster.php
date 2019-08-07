<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Centrosparametros */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
use common\helpers\ComboHelper;
?>
<div class="centrosparametros-form">

   
    <?php $form = ActiveForm::begin(['id' => 'registration-form','enableClientValidation'=>true ]); ?>
<?php echo  $form->errorSummary($model); ?>
    <?= $form->field($model, 'codparam')->textInput(['disabled'=>'disabled','enableAjaxValidation' => true,'size' => 4]) ?>

    <?= $form->field($model, 'desparam')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->checkbox([]) ?>
    <?= $form->field($model, 'flag')->checkbox([]) ?>
     <?= $form->field($model,'tipodato')->
            dropDownList(
                    ['C'=>yii::t('base.forms','Character'),
                     'N'=>yii::t('base.forms','Numeric'),
                    ],
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                     //'class'=>'probandoSelect2',
                        ]
                    ) ?>

    <?= $form->field($model, 'longitud')->textInput(['maxlength' => 3]) ?>

    <?= $form->field($model, 'explicacion')->textarea(['rows' => 6]) ?>
   
    <div class="form-group">
        <?= Html::submitButton(Yii::t('base.verbs', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    
   
    <?php ActiveForm::end(); ?>
    
     <?= Html::a('haz click','#',['guey'=>'34','id' => 'holis_papa']) ?>

      <?= Html::script("$('#holis_papa').on( 'click', function() { 
          ruta='".\yii\helpers\Url::toRoute(['finder/alert'])."';
            ruta=ruta.concat('/',this.guey);
          $.ajax({
              url: ruta,
              type: 'GET',
              dataType: 'json',        
             beforeSend: function() {                           
                        },
               error:  function(xhr, textStatus, error){
               
                            var n = Noty('id');
                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');  
      
                                }, 
              success: function(json) {
                        var n = Noty('id');
                        if ( json.includes('error') ) {
                              $.noty.setText(n.options.id, json['error']);
                              $.noty.setType(n.options.id, 'error');   
                            }else{
                            $.noty.setText(n.options.id, json['success']);
                              $.noty.setType(n.options.id, 'success');  
                            }
                            
                                             
                        }
                        });  "
            . "})");
       ?>     
</div>
