<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="modal fade create-category-<?=$aleatorio ?>" id="modal-create-contact" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?=$titulo ?></h4>
            </div>

            <div class="modal-body">
               <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'nombres')->textInput(['disabled'=>'disabled','maxlength' => true]) ?>
    </div>
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'moviles')->textInput(['maxlength' => true]) ?>
      </div>
   
   
 <div class="modal-footer">
                <div class="pull-left">
                     <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
       
   
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times-circle"></span> &nbsp;cancelar</button>
                </div>
            </div>
                
                
      
      

    <?php ActiveForm::end(); ?>
            </div>

        
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.create-category-{{ $rand }}#modal-create-category').modal('show');

        $('.create-category-{{ $rand }} #category-color-picker').colorpicker();
    });

    $(document).on('click', '.create-category-{{ $rand }} #button-create-category', function (e) {
        $('.create-category-{{ $rand }}#modal-create-category .modal-header').before('<span id="span-loading" style="position: absolute; height: 100%; width: 100%; z-index: 99; background: #6da252; opacity: 0.4;"><i class="fa fa-spinner fa-spin" style="font-size: 10em !important;margin-left: 35%;margin-top: 8%;"></i></span>');

        $.ajax({
            url: '{{ url("modals/categories") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $(".create-category-{{ $rand }} #form-create-category").serialize(),
            beforeSend: function () {
                $('.create-category-{{ $rand }} #button-create-category').button('loading');

                $(".create-category-{{ $rand }} .form-group").removeClass("has-error");
                $(".create-category-{{ $rand }} .help-block").remove();
            },
            complete: function() {
                $('.create-category-{{ $rand }} #button-create-category').button('reset');
            },
            success: function(json) {
                var data = json['data'];

                $('.create-category-{{ $rand }} #span-loading').remove();

                $('.create-category-{{ $rand }}#modal-create-category').modal('hide');

                $('#category_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>');
                $('#category_id').trigger('change');
                $('#category_id').select2('refresh');

                @if ($category_selector)
                $('{{ $category_selector }}').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>');
                $('{{ $category_selector }}').trigger('change');
                $('{{ $category_selector }}').select2('refresh');
                @endif
            },
            error: function(error, textStatus, errorThrown) {
                $('.create-category-{{ $rand }} #span-loading').remove();

                if (error.responseJSON.name) {
                    $(".create-category-{{ $rand }}#modal-create-category input[name='name']").parent().parent().addClass('has-error');
                    $(".create-category-{{ $rand }}#modal-create-category input[name='name']").parent().after('<p class="help-block">' + error.responseJSON.name + '</p>');
                }

                if (error.responseJSON.color) {
                    $(".create-category-{{ $rand }}#modal-create-category input[name='color']").parent().parent().addClass('has-error');
                    $(".create-category-{{ $rand }}#modal-create-category input[name='color']").parent().after('<p class="help-block">' + error.responseJSON.color + '</p>');
                }
            }
        });
    });
</script>
