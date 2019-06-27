<aside class="main-sidebar">
    
    
    

    <section class="sidebar">
        
        
        
        
        <div class="form-group field-clipro-codpro">
            <a><i class="fa fa-bolt" aria-hidden="true"></i><label class="control-label" for="cboFavorites" ><?=yii::t('base.forms','Direct Access') ?></label></a>
            <?= \yii\helpers\Html::dropDownList(
                    'cboFavorites',null,\common\helpers\h::getCboFavorites(),
                    ['prompt'=>'--'.yii::t('base.forms','Choose a Favorite').'--','id'=>'cboFavorites','class'=>'form-control btn btn-success ']) ?>
        </div>
       
    

           <?php $items=mdm\admin\components\MenuHelper::getAssignedMenu(yii::$app->user->id);?>  
       
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
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });" ); ?>
   
   

</aside>
