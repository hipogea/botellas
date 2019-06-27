  <?php use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  ?>

<div class="install-image"></div>

        <div class="install-content">
            <div class="install-logo">
                <img src=" <?= yii\helpers\Url::to("@web/img/akaunting-logo-white.png") ?> " alt="Akaunting" />
            </div>

            <div class="box box-success box-solid">
                <div class="box-header">
                    <div class="col-md-12">
                        <h3 class="box-title"><?=  Yii::t('install.procedures', 'Setting Database.') ?></h3>
                    </div>
                </div>
                <!-- /.box-header -->

                <div id="install-form">
                    
                    
                       <?php $form = ActiveForm::begin(['id' => 'form-database']); ?>
                   
                    
                    <div class="col-md-12">
           <?= $form->field($model, 'username') ?>
                    </div>
                     <div class="col-md-12">
               <?= $form->field($model, 'password') ?>
                         </Div>
                 <div class="box-footer">
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-8 text-right">
                                 <?= Html::submitButton(Yii::t('install.procedures', 'Next'), ['id' => 'next-button','class' => 'btn btn-success']) ?>
                                
                            </div>
                        </div>
                    </div>
            <?php ActiveForm::end(); ?>
                    
             </div>        
                    
                    
                    
                </div>

                <script type="text/javascript">
                    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

                    $('#next-button').on('click', function() {
                        $('#install-loading').html('<span class="install-loading-bar"><span class="install-loading-spin"><i class="fa fa-spinner fa-spin"></i></span></span>');
                        $('.install-loading-bar').css({"height": $('#install-form').height() - 12});
                    });
                </script>
            </div>
        