  <?php use yii\helpers\Html; ?>

<div class="install-image"></div>

        <div class="install-content">
            <div class="install-logo">
                <img src=" <?= yii\helpers\Url::to("@web/img/akaunting-logo-white.png") ?> " alt="Akaunting" />
            </div>

            <div class="box box-success box-solid">
                <div class="box-header">
                    <div class="col-md-12">
                        <h3 class="box-title">Select Language</h3>
                    </div>
                </div>
                <!-- /.box-header -->

                <div id="install-form">
                    <?= Html::beginForm(/*\Yii::$app->urlManager->createUrl("install/database/show")*/) ?>



                    <div class="box-body">
                        <div id="install-loading"></div>

                       
                        
                        <div class="form-group">
                            <div class="col-md-12">
                                
                            </div>
                        </div>

                        
                        
                        
                        <div class="form-group">
        <div class="col-md-12">
            <select name="lang" id="lang" size="17" class="form-control">
                <option value="es_PE" selected>Spanish</option>
                <option value="en_US" >English</option> <!-- Opción por defecto -->
                <option value="pt_BR">Portugués</option>
            </select>
        </div>
    </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-8 text-right">
                                 <?= Html::submitButton(Yii::t('install.procedures', 'Next'), ['id' => 'next-button','class' => 'btn btn-success']) ?>
                                
                            </div>
                        </div>
                    </div>

                    <?= Html::endForm() ?>
                </div>

                <script type="text/javascript">
                    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

                    $('#next-button').on('click', function() {
                        $('#install-loading').html('<span class="install-loading-bar"><span class="install-loading-spin"><i class="fa fa-spinner fa-spin"></i></span></span>');
                        $('.install-loading-bar').css({"height": $('#install-form').height() - 12});
                    });
                </script>
            </div>
        </div>






















