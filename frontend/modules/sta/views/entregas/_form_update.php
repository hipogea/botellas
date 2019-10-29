 <?php  
 use kartik\tabs\TabsX;
?>
<div class="box box-success">
<?php if(!$model->isNewRecord){
    
 echo TabsX::widget([
     'position' => TabsX::POS_ABOVE,
     'bordered'=>true,
    'align' => TabsX::ALIGN_LEFT,
      'encodeLabels'=>false,
    'items' => [
        [
            'label' => '<i class="fa fa-home"></i> '.yii::t('base.names','Base'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_form',[ 'model' => $model]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => true,
             'options' => ['id' => 'myveryownID3'],
        ],
        [
            'label' =>'<i class="fa fa-upload"></i> '. yii::t('base.names','Cargas'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_loads',[  'model' => $model,'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'dataProviderFields'=>$dataProviderFields,
        ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myveryownID4'],
        ],
        [
            'label' =>'<i class="fa fa-table"></i> '. yii::t('base.names','Estruc Archivo'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render((!is_null($modelCarga))?'_estructura':'_vacio',[  'model' => $modelCarga, 'dataProviderFields'=>$dataProviderFields,
        ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myveryowntf57ID4'],
        ],
      
    ],
]);  
 }
  
    
    ?> 
</div>