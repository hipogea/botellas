<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;

use yii\helpers\Url;

use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Direcciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="direcciones-form">

    <?php $form = ActiveForm::begin(); ?>
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?php 
  // $necesi=new Parametros;
    echo \common\widgets\selectwidget\selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codpro',
            //'foreignskeys'=>[1,2,3],
        ]);  ?>
    </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'direc')->textInput(['maxlength' => true]) ?>

 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'nomlug')->textInput(['maxlength' => true]) ?>

 
 </div>  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">     <?= $form->field($model, 'latitud')->textInput(['maxlength' => true]) ?>

 </div>  
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ComboHelper::getCboDepartamentos(),
               'campo'=>'coddepa',
               'idcombodep'=>'direcciones-codprov',
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
                   'source'=>[\common\models\masters\Ubigeos::className()=>
                                [
                                  'campoclave'=>'codprov' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'provincia',//columna a mostrar 
                                        'campofiltro'=>'coddepa'  
                                ]
                                ],
                            ]
               
               
        )  ?>
 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ($model->isNewRecord)?[]:ComboHelper::getCboProvincias($model->coddepa),
               'campo'=>'codprov',
               'idcombodep'=>'direcciones-coddist',
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
                   'source'=>[\common\models\masters\Ubigeos::className()=>
                                [
                                  'campoclave'=>'coddist' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'distrito',//columna a mostrar 
                                        'campofiltro'=>'codprov'  
                                ]
                                ],
                            ]
               
               
        )  ?>
 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">    
 <?= $form->field($model, 'coddist')->
            dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboDistritos($model->codprov),
                  ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>  
 

      <div class="form-group">
        <?= Html::submitButton(Yii::t('base.names', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
