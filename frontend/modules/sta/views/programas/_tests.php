<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use frontend\modules\sta\models\StaTestTalleres;
?>
<div class="talleres-index">
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <?= Html::dropDownList("combo_test_alone",null,
          frontend\modules\sta\helpers\comboHelper::getCboTests(),
            ['prompt'=>'--Seleccione un Valor--',
             'class'=>'form-group form-control',
                'id'=>'combo_test_alone'])  ?>
    </div>
      <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
        <button id="boton-agregar-test" type="button" class="btn btn-warning btn-sm">
            <span class="glyphicon glyphicon-arrow-right  "></span>    <?=yii::t('sta.labels','  Agregar')?>
        </button>
      </div>
  
    
   
     <div class="box-body">
    <?php Pjax::begin(['id'=>'grilla-tests']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => StaTestTalleres::find()->where(['taller_id'=>$model->id])]),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}{view}',
                'buttons' => [
                   
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                         'delete' => function ($url,$model) {
			    $url = Url::toRoute($this->context->id.'/ajax-detach-psico',['id'=>$model->id]);
                             return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=> \yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                    ]
                ],
         
         
         
         
         

           'codtest',
            'test.descripcion',
                            
                                [
    'attribute' => 'obligatorio',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('obligatorio[]', $model->obligatorio, [ 'disabled' => true]);

             },

          ],
            //'fclose',
            //'codcur',
            //'activa',
            //'codperiodo',
            //'electivo',
            //'ciclo',

          
        ],
    ]);
             
        echo linkAjaxGridWidget::widget([
           'id'=>'mifpapaxx',
            'idGrilla'=>'grilla-staff',
            'family'=>'holas',
          'type'=>'GET',
           'evento'=>'click',
            //'foreignskeys'=>[1,2,3],
        ]); 
         
             ?>
    <?php Pjax::end(); ?>

    </div>

  <?php    $this->registerJs("
         
$('#boton-agregar-test').on( 'click', function(){   
  var valorcombo;
  valorcombo=$('#combo_test_alone').val(); 
  $.ajax({ 
  
   method:'post',    
      url: '".\yii\helpers\Url::toRoute('/sta/programas/agrega-test')."',
   delay: 250,
 data: {id:".$model->id.",codtest:valorcombo},
             error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(json) {  
                        var n = Noty('id');
                       if ( !(typeof json['error']==='undefined') ) {
                                        $.noty.setText(n.options.id,'<span style=\'color:red;\' class=\'glyphicon glyphicon-info-sign\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error'); 
                              }
                         if ( !(typeof json['success']==='undefined') ) {
                                        $.noty.setText(n.options.id, json['success']);
                             $.noty.setType(n.options.id, 'success');
                              } 
                               if ( !(typeof json['warning']==='undefined') ) {
                                        $.noty.setText(n.options.id, json['warning']);
                             $.noty.setType(n.options.id, 'warning');
                              } 
                             
                       $.pjax.reload({container: '#grilla-tests'});
                        },
   cache: true
  })
 }
 
);",\yii\web\View::POS_END);  
  ?>

      </div>