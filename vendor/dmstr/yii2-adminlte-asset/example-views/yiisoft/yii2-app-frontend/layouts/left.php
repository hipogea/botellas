<aside class="main-sidebar">
    
    
    

    <section class="sidebar">
        
        
        
        
        <div class="form-group field-clipro-codpro">
             <?= \yii\helpers\Html::dropDownList(
                    'cboFavorites',null,\common\helpers\h::getCboFavorites(),
                    ['prompt'=>'--'.yii::t('base.forms','Escoja dirección').'--','id'=>'cboFavorites','class'=>'form-control btn btn-success ']) ?>
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
   
    <?php 
  $this->registerJs(' 
    jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
       }', \yii\web\View::POS_HEAD); ?>
  
    
      <?php 
  $this->registerJs(' 
    jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
       }', \yii\web\View::POS_HEAD); ?>
    

</aside>
