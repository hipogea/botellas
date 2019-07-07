  <?php use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  ?>

<div class="install-image"></div>

        <div class="install-content">
            <div class="install-logo">
                <img src=" <?= yii\helpers\Url::to("@web/img/akaunting-logo-white.png") ?> " width="20"  height="60"  alt="Akaunting" />
            </div>

            <div class="box box-success box-solid">
                <div class="box-header">
                    <div class="col-md-12">
                        <h3 class="box-title">
                            <div style="display:table">
  
  
</div>
                            
                            
                            
                            <div class="row">
                                <div style="float:left;font-size:14px !important; width:210px; color:white !important;">
                           <i class="fa fa-question" aria-hidden="true"></i>
                            <?= Html::a(yii::t('base.actions','If you forgot your password you can'), ['site/request-password-reset']) ?> <?='      '?>  
                          </diV><div style="float:right;font-size:14px !important; color:white !important;">
                          <i class="fa fa-address-book" aria-hidden="true"></i>
                            <?= Html::a(yii::t('base.actions','Register'), ['site/signup']) ?>
                          
                         </div>
                            </div>
                          
                           </h3>
                    </div>
                </div>
                <!-- /.box-header -->

                <div id="install-form">
                    
                    
                       <?php $form = ActiveForm::begin(['id' => 'form-database']); ?>
                   
                    
                    <div class="col-md-12">
                      
           <?= $form->field($model, 'username')->textInput()->label(yii::t('base.names','UserName'))  ?>
                    </div>
                     <div class="col-md-12">
                        
               <?= $form->field($model, 'password')->passwordInput() ?>
                         </Div>
                    <div class="col-md-12">
                    <?= $form->field($model, 'rememberMe')->checkbox(['label'=>null])->label(yii::t('base.names','Remember Me'))  ?>
                       </diV>
                        <div class="row">
                      
                   <div class="box-footer">
                      
                            <div class="col-md-4 col-md-offset-8 text-right">
                                 <?= Html::submitButton(Yii::t('base.verbs', 'Login'), ['id' => 'next-button','class' => 'btn btn-success']) ?>
                                
                            </div>
                       
                    </div>
                      </div> 
            <?php ActiveForm::end(); ?>
                    
                   
                    
                    
                    
                </div>

                <script type="text/javascript">
                    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

                    $('#next-button').on('click', function() {
                        $('#install-loading').html('<span class="install-loading-bar"><span class="install-loading-spin"><i class="fa fa-spinner fa-spin"></i></span></span>');
                        $('.install-loading-bar').css({"height": $('#install-form').height() - 12});
                    });
                </script>
            </div>
        