<?php
use common\helpers\ComboHelper;
use frontend\modules\bigitems\models\Docbotellas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
//use kartik\depdrop\DepDrop;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\ImportCargamasiva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="import-cargamasiva-form">
<div class="box box-success">
    <?php $form = ActiveForm::begin(); ?>
    
  <div class="box-footer">
        <div class="col-md-12">
            <div class="form-group no-margin">
        <?= Html::submitButton(Yii::t('import.labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
     </div>
    </div>
    <div class="box-body">
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
      <?= $form->field($model, 'descripcion')->textInput() ?>

 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'user_id')->textInput() ?>

 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'insercion')->checkBox() ?>

 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
   <?= $form->field($model, 'escenario')->
            dropDownList(($model->isNewRecord)?[]:[$model->escenario=>$model->escenario],
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                       ]
                    ) ?>
 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?= $form->field($model, 'lastimport')->textInput(['maxlength' => true]) ?>

 </div>
  
    
   
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
  <?= $form->field($model, 'format')->textInput(['maxlength' => true]) ?>

 </div>
 <div class="col-md-12"> 
  
    
    <?= ComboDep::widget([
               'model'=>$model,
               'controllerName'=>'import/importacion',
               'actionName'=>'escenarios',
               'form'=>$form,
               'data'=> ComboHelper::getCboModels(),
               'campo'=>'modelo',
               'idcombodep'=>'importcargamasiva-escenario',
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
    
    
  


    
    <?php ActiveForm::end(); ?>




 <?php  
 if(!$model->isNewRecord){
    //var_dump($this->context);die();
 echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => yii::t('base.names','Fields'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_campos',[ 'form' => $form, 'dataProvider' => $itemsFields]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => true,
             'options' => ['id' => 'myveryownID3'],
        ],
        [
            'label' => yii::t('base.names','Loads'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_loads',[  'model' => $model,'form' => $form, 'dataProvider' => $itemsLoads]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myveryownID4'],
        ],
       /*[
            'label' => yii::t('base.names','Resultados'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_resultados',[ ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myveryowyynID4'],
        ],*/
    ],
]);  
 }
  
    
    ?> 
</div>
</div>
</div>
    
    

    
  