  <?php use yii\helpers\Html;  use yii\widgets\ActiveForm; ?>
<div class="install-image"></div>

        <div class="install-content">
            <div class="install-logo">
                <img src=" <?= yii\helpers\Url::to("@web/img/akaunting-logo-white.png") ?> " alt="Akaunting" />
            </div>

            <div class="box box-success box-solid">
                <div class="box-header">
                    <div class="col-md-12">
                        <h3 class="box-title"><?=yii::t('install.procedures','Setting Mail Server')?></h3>
                    </div>
                </div>
                <!-- /.box-header -->

              
                
                <div id="install-form">
                            <?php $form = ActiveForm::begin(['id' => 'form-database']); ?>
                    <div class="col-md-12">
                        <?= $form->field($model, 'serverMail') ?>
                    </div>    
            <div class="col-md-12">
           <?= $form->field($model, 'userMail') ?>
                </div> 
                     <div class="col-md-12">
           <?= $form->field($model, 'passwordMail') ?>
                </div> 
                    <div class="col-md-12">
           <?= $form->field($model, 'portMail')
                ->dropDownList(
                    ['25' => '25', '26' => '26', '465' => '465'],
                    ['prompt' => '--Select Port--', 'id' => 'portmail']
                ); ?>
                    </div>
                     
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
        </div>






















