<?php

use yii\helpers\Html;

use kartik\tabs\TabsX;


/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\Edificios */

$this->title = Yii::t('sigi.labels', 'Update Edificios: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sigi.labels', 'Edificios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sigi.labels', 'Update');
?>


    
   <h4><i class="fa fa-edit"></i><?= Html::encode($this->title) ?></h4>
   <div class="box box-success">
    <?php echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
     'bordered'=>true,
    'align' => TabsX::ALIGN_LEFT,
      'encodeLabels'=>false,
    'items' => [
        [
          'label'=>'<i class="fa fa-hospital"></i> '.yii::t('sta.labels','Edificio'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_form',['model' => $model]),
            'active' => true,
             'options' => ['id' => 'myveryownID3'],
        ],
        [
          'label'=>'<i class="fa fa-cubes"></i> '.yii::t('sta.labels','Unidades'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_unidades',[ 'model' => $model]),
            'active' => false,
             'options' => ['id' => 'myveryownID4'],
        ],
        [
          'label'=>'<i class="fa fa-users"></i> '.yii::t('sta.labels','Apoderados'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_apoderados',[ 'model' => $model]),
            'active' => false,
             'options' => ['id' => 'myveryoddwnID4'],
        ],
       
        
       
    ],
]);  ?>

</div>
