<?php
use kartik\tabs\TabsX;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
$this->title = Yii::t('sta.labels', 'Modificar Programa: {name}', [
    'name' => $model->numero,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Talleres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sta.labels', 'Update');
?>
<div class="talleres-update">

    <h4><i class="fa fa-edit"></i><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
 
    <?php  
 if(!$model->isNewRecord){
    //var_dump($this->context);die();
 echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
     'bordered'=>true,
    'align' => TabsX::ALIGN_LEFT,
      'encodeLabels'=>false,
    'items' => [
        [
          'label'=>'<i class="fa fa-home"></i> '.yii::t('sta.labels','Principal'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_form',['model' => $model]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => true,
             'options' => ['id' => 'tabid1'],
        ],
        [
          'label'=>'<i class="fa fa-users"></i> '.yii::t('sta.labels','Tutores'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_staff',[ 'model' => $model,'dataProviderStaff'=>$dataProviderStaff]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'tabid2'],
        ],
       [
            'label'=>'<i class="fa fa-map-o"></i> '.yii::t('sta.labels','Resultados'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_resultados',[ ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
             'items'=>[
             [
                 'label'=>'Option 1',
                 'encode'=>false,
                 'content'=>'Un contenido',
             ],
             [
                 'label'=>'Option 2',
                 'encode'=>false,
                 'content'=>'Otro contenido',
             ],
           ],
           'active' => false,
             'options' => ['id' => 'tabID3'],
        ],
        [
            'label'=>'<i class="fa fa-users"></i> '.yii::t('sta.labels','Alumnos'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->renderAjax('_alumnos',[ 'dataProviderAlumnos'=>$dataProviderAlumnos, 'searchAlumnos' => $searchAlumnos,'model'=>$model ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'tabID4'],
        ],
        [
            'label'=>'<i class="fa fa-users"></i> '.yii::t('sta.labels','Test'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_tests',['model'=>$model ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
              'options' => ['id' => 'tabID5'],
        ],
        [
            'label'=>'<i class="fa fa-calendar"></i> '.yii::t('sta.labels','Rangos'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('rangos',['model'=>$model,'dataProviderRangos'=> $dataProviderRangos ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'tabID6'],
        ],
    ],
]);  
 }
  
    
    ?> 

</div>
    </div>

