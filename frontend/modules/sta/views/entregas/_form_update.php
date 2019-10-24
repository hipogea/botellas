 <?php  
 use kartik\tabs\TabsX;
?>
<div class="box box-success">
<?php if(!$model->isNewRecord){
    
 echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => yii::t('base.names','Base'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_form',[ 'model' => $model]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => true,
             'options' => ['id' => 'myveryownID3'],
        ],
        [
            'label' => yii::t('base.names','Cargas'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_loads',[  'model' => $model]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myveryownID4'],
        ],
      
    ],
]);  
 }
  
    
    ?> 
</div>