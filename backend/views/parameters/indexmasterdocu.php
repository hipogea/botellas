<?php
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\CentrosparametrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base.names', 'Parameters for Documents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrosparametros-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(yii::t('base.verbs','Create').'  '.$this->title, ['createparamdocu'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'id'=>'grillaPapo',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            'codparam',
            'parametros.desparam',
            'codocu',
            'documentos.desdocu',
            
            //'valor2',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{borrar}',
                'buttons' => [
		
                 'borrar' => function ($url,$model) {
			    $url = Url::to('deletemodel');
                             return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=>Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                        ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'grirt',
            'idGrilla'=>'grillaPapo',
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>