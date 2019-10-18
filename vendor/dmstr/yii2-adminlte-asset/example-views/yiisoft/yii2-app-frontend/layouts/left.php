<aside class="main-sidebar">
    
    
    

    <section class="sidebar">
        
        
        
        
        <div class="form-group field-clipro-codpro">
             <?= \yii\helpers\Html::dropDownList(
                    'cboFavorites',null,\common\helpers\h::getCboFavorites(),
                    ['prompt'=>'--'.yii::t('base.forms','Ir a ...').'--','id'=>'cboFavorites','class'=>'form-control btn btn-success ']) ?>
        </div>
       
    

           <?php $items=mdm\admin\components\MenuHelper::getAssignedMenu(yii::$app->user->id
                   ,null/*root*/, 
                    null,false/*refresh*/);?>  
       <?php  //print_r($items); die();?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' =>$items ,
            ]
        ) ?>
    </section>
    
    
    
    <?php echo \yii\helpers\Html::script("$(function(){
      // bind change event to select
      $('#cboFavorites').on('change', function () {
          var url = $(this).val(); // get selected value
          var abso='".\yii\helpers\Url::home(true)."';
          window.location=abso+url;
          
          return false;
      });
    });" ); ?>
   
   

</aside>
