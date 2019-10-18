<?php use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
?>
<div style='overflow:auto;'>
     <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'id'=>'grilla-cargas',
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
    'attribute' => 'estricto',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('estricto[]', $model->estricto, [ 'disabled' => true]);

             },

          ],
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{detailCarga}{tryCarga}{loadCarga}{deleteCarga}{attachCarga}{detachCarga}',
               'buttons' => [
                    'attachCarga' => function($url, $model) {  
                        if(true/*$this->context->isVisible('attachCarga',$model->activo)*/){
                           $url=\yii\helpers\Url::toRoute(['/finder/selectimage','extension'=>'csv','isImage'=>false,'idModal'=>'imagemodal','modelid'=>$model->id,'nombreclase'=> str_replace('\\','_',get_class($model))]);
                        $options = [
                            'title' => Yii::t('sta.labels', 'Subir Archivo'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            //'data-pjax' => '0',
                        ];
                        return Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'title' => 'Editar Adjunto', 'class' => 'botonAbre btn btn-success']);
                        //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                     
                        }else{
                            return '';
                        }
                        },
                        
                        
                        'detailCarga' => function($url, $model) {  
                        if(true /*$this->context->isVisible('detailCarga',$model->activo)*/){
                           $url=\yii\helpers\Url::toRoute(['/finder/selectimage','extension'=>'csv','isImage'=>false,'idModal'=>'imagemodal','modelid'=>$model->id,'nombreclase'=> str_replace('\\','_',get_class($model))]);
                        $options = [
                            'title' => Yii::t('sta.labels', 'Detalles'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            //'data-pjax' => '0',
                        ];
                        return Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'title' => 'Editar Adjunto', 'class' => 'botonAbre btn btn-success']);
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
   <?= Html::buttonInput(yii::t('sta.labels','Crear carga'), ['id'=>'btn-carga-nueva','class' => 'btn btn-info']) ?> 
    
</div>
<?php 
  $this->registerJs("$('#btn-carga-nueva').on( 'click', function() { 
            $.ajax({
              url: 'new-carga', 
              type: 'POST',
              data:{identidad:".$model->id."},
              dataType: 'json',        
            // beforeSend: function() {  
            // return confirm('Are you Sure to Delete this Record ?');
                      //  },
               error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(json) {
              
               //alert(typeof json['dfdfd']==='undefined');
                        var n = Noty('id');
                       if ( typeof json['error']==='undefined' ) {
                        $.pjax({container: '#grilla-cargas'});
                             $.noty.setText(n.options.id, json['success']);
                             $.noty.setType(n.options.id, 'success'); 
                            
                            }else{
                            $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error');  
                            }
                   
                        }
                        });  })", View::POS_READY);
?>




    
    

    
  