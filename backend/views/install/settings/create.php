  <?php use yii\helpers\Html;  use yii\widgets\ActiveForm; ?>

<div class="install-image"></div>

        <div class="install-content">
            <div class="install-logo">
                <img src=" <?= yii\helpers\Url::to("@web/img/akaunting-logo-white.png") ?> " alt="Akaunting" />
            </div>

            <div class="box box-success box-solid">
                <div class="box-header">
                    <div class="col-md-12">
                        <h3 class="box-title"><?=yii::t('install.procedures','Setting Company')?></h3>
                    </div>
                </div>
                <!-- /.box-header -->

                      <?php $form = ActiveForm::begin(['id' => 'form-database']); ?>
                    <div class="col-md-12">
                        <?= $form->field($model, 'companyName') ?>
                    </div>    
            <div class="col-md-12">
           <?= $form->field($model, 'rucCompany') ?>
                </div> 
                    <div class="col-md-12">
           <?= $form->field($model, 'emailCompany') ?>
                    </div>
                    
                     <div class="col-md-12">
                <?= $form->field($model, 'moneda')->dropDownList(['PEN'=>'PEN','USD'=>'USD','EUR'=>'EUR'], ['prompt' => yii::t('install.procedures','Select Currency') ]);?>
                         </Div>
               </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-8 text-right">
                                 <?= Html::submitButton(Yii::t('install.procedures', 'Next'), ['id' => 'next-button','class' => 'btn btn-success']) ?>
                                
                            </div>
                        </div> 
                    </div>

                     <?php ActiveForm::end(); ?>
  

                <script type="text/javascript">
                    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

                    $('#next-button').on('click', function() {
                        $('#install-loading').html('<span class="install-loading-bar"><span class="install-loading-spin"><i class="fa fa-spinner fa-spin"></i></span></span>');
                        $('.install-loading-bar').css({"height": $('#install-form').height() - 12});
                    });
                </script>
            </div>
       






















