<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\sta\models\AulasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base.names', 'Aulas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aulas-index">
<div class="box box-success">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('base.names', 'Create Aulas'), ['create'], ['class' => 'btn btn-success']) ?>
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
                        return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', \yii\helpers\Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                         },
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning glyphicon glyphicon-search"></span>', \yii\helpers\Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                         },
                         'delete' => function($url, $model) {                        
                        $options = [
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'title' => Yii::t('base.verbs', 'Delete'),                            
                        ];
                        return Html::a('<span class="btn btn-danger glyphicon glyphicon-remove"></span>', \yii\helpers\Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                         }
                    ]
                ],
         
         
         
         
         

            'id',
            'codaula',
            'codfac',
            'pabellon',
            'cap',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>