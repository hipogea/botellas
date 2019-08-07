<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\bigitems\models\GuiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('bigitems.labels', 'Guias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-index">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('bigitems.labels', 'Create Guia'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}{view}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'Update'),                            
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                         'delete' => function($url, $model) {                        
                        $options = [
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'title' => Yii::t('base.verbs', 'Delete'),                            
                        ];
                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', $url, $options/*$options*/);
                         }
                    ]
                ],
         
         
         
         
         

            'id',
            'numgui',
            'descripcion',
            'serie',
            'codpro',
            //'codpro_tran',
            //'fecha',
            //'fecha_tran',
            //'codestado',
            //'chofer',
            //'codmotivo',
            //'placa',
            //'confvehicular',
            //'brevete',
            //'ptopartida_id',
            //'ptollegada_id',
            //'codcen',
            //'codocu',
            //'comentario:ntext',
            //'essalida',

          
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>