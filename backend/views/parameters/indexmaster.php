<?php
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\CentrosparametrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base.names', 'Parameter');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrosparametros-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Parameter'), ['createmaster'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'id'=>'grillaprueba',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            'codparam',
            'desparam',
            'longitud',
            'tipodato',
            'longitud',
            //'valor2',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{borrar}',
                'buttons' => [
		'update' => function ($url,$model) {
			    $url = Url::to([$this->context->id.'/updatemaster', 'id' => $model->codparam]);
                             return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => 'Update']);
                            },
                 'borrar' => function ($url,$model) {
			    $url = Url::to('deletemodel');
                             return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=>Json::encode(['id'=>$model->codparam,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                        ],
            ],
            
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'mifpapaxx',
            'idGrilla'=>'grillaprueba',
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>
