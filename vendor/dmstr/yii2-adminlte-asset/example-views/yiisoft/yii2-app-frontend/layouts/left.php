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
    
    
   
 <?php 
  $this->registerJs("$(document).ready(
      function(){
            $(document).ajaxStart(function(){
                                        $('#ajax-loading').css('display', 'block');
                                        $('#wait').center();
                                            }
                                  );
            $(document).ajaxComplete(function(){
                                        $('#ajax-loading').css('display', 'none'); 
                                                }
                                 );

                });", \yii\web\View::POS_READY);
?>
 
  <div id="ajax-loading" 
     style="display:none;
     position: fixed;
     text-align: center;
     background-color:rgb(56,154,31,0.6);    
left: 50%;
top: 50%;
width:30%;
height:20%;
border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 0px solid #000000;
transform: translate(-50%, -50%);
-webkit-box-shadow: 0px 2px 4px 1px rgba(21,140,37,1);
-moz-box-shadow: 0px 2px 4px 1px rgba(21,140,37,1);
box-shadow: 0px 2px 4px 1px rgba(21,140,37,1);


     ">
      <div style="margin:auto;
           position:absolute;
        top: 40%;
        left:35%;
        
           display:inline-block;">
          <img src="<?= \common\helpers\FileHelper::UrlLoadingImage() ?>" width="40%" height="40%" />
          <br><span style="color:white;">Procesando ...</span>
      </div>
</div> 
        
    
    

</aside>
