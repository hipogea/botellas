<?php
use kartik\tabs\TabsX;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */

$this->title = Yii::t('sta.labels', 'Update Talleres: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Talleres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sta.labels', 'Update');
?>
<div class="talleres-update">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?php  
 if(!$model->isNewRecord){
    //var_dump($this->context);die();
 echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => yii::t('sta.labels','General'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_form',['model' => $model]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => true,
             'options' => ['id' => 'myveryownID3'],
        ],
        [
            'label' => yii::t('sta.labels','Staff'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_staff',[ 'searchStaff' =>$searchStaff,  'model' => $model,'dataProviderStaff'=>$dataProviderStaff]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myveryownID4'],
        ],
       [
            'label' => yii::t('sta.labels','Resultados'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_resultados',[ ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myveryowyynID4'],
        ],
        [
            'label' => yii::t('sta.labels','Alumnos'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_alumnos',[ 'dataProviderAlumnos'=>$dataProviderAlumnos, 'searchAlumnos' => $searchAlumnos,'model'=>$model ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myveryofgwyynID4'],
        ],
    ],
]);  
 }
  
    
    ?> 

</div>
    </div>