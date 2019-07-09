<?php 
use yii\widgets\Pjax;
use kartik\editable\Editable;
use yii\helpers\Html;
  ?>
<div style="overflow:auto;" >
<?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= kartik\grid\GridView::widget([
        'id'=>'detallerepoGrid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{editar}',
                'buttons' => [
	
                 'editar' => function ($url,$model) {
			    $url = \yii\helpers\Url::to(['updatedetallerepo','id'=>$model->id,'nombregrilla'=>'detalleRepoGrid']);
                             return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                            }
                        ],
            ],
           
            
             'aliascampo',
            //'tipodato',
            [
                        'class' => 'kartik\grid\EditableColumn',
                
                        'editableOptions'=>[
                            //'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                          'data'=>['1'=>'Yes','0'=>'No'],  
                                            ],
                        'attribute' => 'esdetalle',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
            [
                        'class' => 'kartik\grid\EditableColumn',
                
                        'editableOptions'=>[
                            //'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                             'data'=>['xbriyaz'=>'xbriyaz','verdana'=>'verdana','arial'=>'arial','courier'=>'courier'], 
                                            ],
                        'attribute' => 'font_family',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
            [
                        'class' => 'kartik\grid\EditableColumn',
                
                        'editableOptions'=>[
                          //  'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                             'data'=>['1'=>'Yes','0'=>'No'], 
                                            ],
                        'attribute' => 'visiblecampo',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
	    [
                        'class' => 'kartik\grid\EditableColumn',
                        'editableOptions'=>[
                                            ],
                        'attribute' => 'left',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],  
            [
                        'class' => 'kartik\grid\EditableColumn',
                        'editableOptions'=>[
                                            ],
                        'attribute' => 'top',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
		  
		   		  
		   'lbl_left',
		   'lbl_top',
		   'lbl_font_size',
		   
		   'visiblelabel',
		   'lbl_font_color',
		   'visiblecampo',
		  
                ],
        ]
    ); ?>

<?php Pjax::end(); ?>
  </div>  