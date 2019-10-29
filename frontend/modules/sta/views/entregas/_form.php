<?php
USE frontend\modules\sta\helpers\comboHelper;  
use frontend\modules\sta\widgets\cboperiodos\cboperiodos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use common\helpers\h;
use yii\widgets\ActiveForm;
 use kartik\date\DatePicker;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
 
 
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Entregas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entregas-form">
    <?php $form = ActiveForm::begin(['id'=>'entregas-form',/*'enableAjaxValidation' => true*/]); ?>
      <div class="box-header">        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span>".".     .".Yii::t('sta.labels', 'Guardar'), ['class' => 'btn btn-success']) ?>
           
    

            </div>
        </div>
    </div>
    
    <?PHP //ECHO $model->files[0]->getPath();?>
      <div class="box-body">

 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
      <?= $form->field($model, 'numero')->textInput(['disabled'=>'disabled']) ?>

 </div>
           <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
  
    
    <?= ComboDep::widget([
               'model'=>$model,
               'controllerName'=>'import/importacion',
               'actionName'=>'escenarios',
               'form'=>$form,
               'data'=> ComboHelper::getCboModelsByModule('sta'),
               'campo'=>'modelo',
               'idcombodep'=>'entregas-escenario',
        /* Opciones del input*/
                'inputOptions'=>[ 'disabled'=>(($model->cargamasiva_id)>0)?'disabled':false,],
               /* 'source'=>[ //fuente de donde se sacarn lso datos 
                    /*Si quiere colocar los datos directamente 
                     * para llenar el combo aqui , hagalo coloque la matriz de los datos
                     * aqui:  'id1'=>'valor1', 
                     *        'id2'=>'valor2,
                     *         'id3'=>'valor3,
                     *        ...
                     * En otro caso 
                     * de la BD mediante un modelo  
                     */
                        /*Docbotellas::className()=>[ //NOmbre del modelo fuente de datos
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'descripcion',//columna a mostrar 
                                        'campofiltro'=>'codenvio'/* //cpolumna 
                                         * columna que sirve como criterio para filtrar los datos 
                                         * si no quiere filtrar nada colocwue : false | '' | null
                                         *
                        
                         ]*/
                   'source'=>[],
                            ]
               
               
        )  ?>
 </div>      
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
   <?= $form->field($model, 'escenario')->
            dropDownList(($model->isNewRecord)?[]:[$model->escenario=>$model->escenario],
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                     'disabled'=>(($model->cargamasiva_id)>0)?'disabled':false,
                       ]
                    ) ?>
 </div> 
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
      <?= $form->field($model, 'fecha',['enableAjaxValidation' => true])->widget(DatePicker::class, [
                            'language' => h::app()->language,
                           'pluginOptions'=>[
                                       'format' => h::getFormatShowDate(),
                                   'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>'2010:'.date('Y'),
                               ],
                          
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>

 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
      <?= $form->field($model, 'fechacorte',['enableAjaxValidation' => true])->widget(DatePicker::class, [
                            'language' => h::app()->language,
                           'pluginOptions'=>[
                                       'format' => h::getFormatShowDate(),
                                   'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>'2010:'.date('Y'),
                               ],
                          
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>

 </div> 
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-md-12"> 
     
     <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'codperiodo',['enableAjaxValidation' => true])->
            dropDownList(comboHelper::getCboPeriodos() ,
                    ['prompt'=>'--'.yii::t('base.verbs','Escoja un valor')."--",
                        //'enableAjaxValidation' => true,
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
     <?php //echo cboperiodos::widget(['model'=>$model,'attribute'=>'codperiodo', 'form'=>$form]) ?>
  </div>
          
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= \common\widgets\imagewidget\ImageWidget::widget(['name'=>'imagenrep','isImage'=>false,'model'=>$model]); ?>
   </div> 
          
   

     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'tienecabecera')->checkBox([ 'disabled'=>($model->hasAttachments())?true:false,]) ?>

 </div>   
          
          
          
          
 <div class="col-md-12"> 
     <?= $form->field($model, 'detalles')->textarea() ?>

 </div>
 
          
          
          
          
    <?php ActiveForm::end(); ?>

</div>
    </div>
