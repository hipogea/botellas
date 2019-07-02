<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\bigitems\models\ActivosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Activos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigo',
            'codigo2',
            'codigo3',
            'descripcion',
            //'marca',
            //'modelo',
            //'serie',
            //'anofabricacion',
            //'codigoitem',
            //'codigocontable',
            //'espadre',
            //'lugar_original_id',
            //'tipo',
            //'codarea',
            //'codestado',
            //'lugar_id',
            //'fecha',
            //'codocu',
            //'numdoc',
            //'entransporte',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
      <?php Pjax::end(); ?>
</div>
