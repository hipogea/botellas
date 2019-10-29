<?php
 use yii\helpers\Url;
 use yii\web\View;
?>
<div class="btn-group">
             <a id="link-carga" href="#" class="btn btn-warning btn-lg ">
                        <i class="glyphicon glyphicon-upload " aria-hidden="true"></i> <?=yii::t('sta.labels','Generar carga')?>
             </a>
             
             
     </div>
<div id="carga-temporal">
    
</div>
<?php 
  $this->registerJs("$('#link-carga').on( 'click', function() { 
      //alert(this.id);
      $.ajax({
              url: '".Url::toRoute(['ajax-create-upload'])."', 
              type: 'get',
              data:{id:".$model->id."},
              dataType: 'json', 
              error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(data) {  
                        $('#carga-temporal').html(data);
                        }
                        });
             })", View::POS_READY);
?>

<?php use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;


?>
     <?php Pjax::begin(['id'=>'grilla-cargas']); ?>
    <?= GridView::widget([
        'id'=>'grillax-cargas',
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [ 'attribute' => 'hasFile',
               'headerOptions' => ['style' => 'width:10%'],
                'format' => 'raw',
                'value' =>  function ($model, $key, $index, $column){
                        //$options=['width' => '40','height' => '42','class'=>"img-thumbnail"];
                        
        return ($model->hasAttachments())?Html::a('<span class="glyphicon glyphicon-paperclip"></span>',$model->urlFirstFile/*, $options*/):
            '<span class="glyphicon glyphicon-folder-open"></span>';
                       
              },
            ],
               
            'descripcion',
            'fechacarga',
            'tienecabecera',
            'duracion',
            'activo',
                              
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{detailCarga}',
               'buttons' => [
                        'detailCarga' => function($url, $model) {  
                        if(true /*$this->context->isVisible('detailCarga',$model->activo)*/){
                          // $url=\yii\helpers\Url::toRoute(['/finder/selectimage','extension'=>'csv','isImage'=>false,'idModal'=>'imagemodal','modelid'=>$model->id,'nombreclase'=> str_replace('\\','_',get_class($model))]);
                        $options = [
                            'id'=>$model->id,
                            'class' => 'carga-boton-ajax',
                            'title' => Yii::t('sta.labels', 'Detalles'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            //'data-method' => 'get',
                            'data-pjax' => '0',
                        ];
                         return Html::a('<span class="btn btn-warning  glyphicon glyphicon-arrow-right"></span>','#', $options/*$options*/);
                       
                        //return Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', ['href' => $url, 'title' => 'Probar', 'class' => 'btn btn-warning']);
                        //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                     
                        }else{
                            return '';
                        }
                         
                        
                        }
                    ]
                ],
        ],
    ]); ?>
 <?php Pjax::end(); ?>

