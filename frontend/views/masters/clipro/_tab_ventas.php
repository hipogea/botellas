<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;

  use common\models\masters\Clipro;
use common\models\masters\Direcciones;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-success">
    

<div class="clipro-form">
<?php $this->registerJs("
    $('.delete-button').click(function() {
        var detail = $(this).closest('.receipt-detail');
        var updateType = detail.find('.update-type');
        if (updateType.val() === " . json_encode(Direcciones::UPDATE_TYPE_UPDATE) . ") {
            //marking the row for deletion
            updateType.val(" . json_encode(Direcciones::UPDATE_TYPE_DELETE) . ");
            detail.hide();
        } else {
            //if the row is a new row, delete the row
            detail.remove();
        }

    });
");
?>

<?php
echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'One',
            'content' => 'Anim pariatur cliche...',
            'active' => true
        ],
        [
            'label' => 'Two',
            'content' => 'Anim pariatur cliche...',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                 [
                     'label' => 'DropdownA',
                     'content' => 'DropdownA, Anim pariatur cliche...',
                 ],
                 [
                     'label' => 'DropdownB',
                     'content' => 'DropdownB, Anim pariatur cliche...',
                 ],
            ],
        ],
    ],
]);    
    
    ?>
    
    
<div class="receipt-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'codpro')->textInput(['disabled'=>'disabled','maxlength' => true]) ?>
    </div>
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'rucpro')->textInput(['maxlength' => true]) ?>
      </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'despro')->textInput(['maxlength' => true]) ?>
    </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'telpro')->textInput(['maxlength' => true]) ?>
         </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>
          </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'deslarga')->textarea(['rows' => 6]) ?>
        </div>
    
    
    
    <?= "<h2>Details</h2>"?>

    
        <div class="form-group col-md-10">
            <label for="items" class="control-label">Items</label>
            <div class="table-responsive">
                <table class="table table-bordered" id="items">
                    <thead>
                        <tr style="background-color: #f9f9f9;">
                                                                    <th width="5%"  class="text-center">Acciones</th>
                                                                                    <th width="40%" class="text-left">Direccion</th>
                                                                                    <th width="20%" class="text-center">Distrito</th>
                                                                                    <th width="20%" class="text-right">Provincia</th>
                                                                                    <th width="15%" class="text-right">Departamento</th>
                                                                                    
                                                    </tr>
                    </thead>
                    <tbody>
                         <?php foreach ($modelDetails as $i => $modelDetail) : ?>
                                    <div class="row receipt-detail receipt-detail-<?= $i ?>">
                                        <tr>
                                                <?= Html::activeHiddenInput($modelDetail, "[$i]codpro") ?>
                                                <?= Html::activeHiddenInput($modelDetail, "[$i]updateType", ['class' => 'update-type']) ?>
                                            <td>
                                            <?= Html::button('x', ['class' => 'delete-button btn btn-danger', 'data-target' => "receipt-detail-$i"]) ?>
                                            </td>
                                            <td>
                                                <?= $form->field($modelDetail, "[$i]direc")->label(false) ?> 
                                            </td>
                                            <td>
                                               <?= $form->field($modelDetail, "[$i]distrito")->label(false) ?> 
                                            </td>
                                            <td>
                                               <?= $form->field($modelDetail, "[$i]provincia")->label(false) ?> 
                                            </td>
                                            <td>
                                               <?= $form->field($modelDetail, "[$i]departamento")->label(false) ?> 
                                            </td>
                                      </tr>
                                    </div>
                        <?php endforeach; ?>
                   </tbody>
                </table>
            </div>
        </div>
    
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton('Add row', ['name' => 'addRow', 'value' => 'true', 'class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</div>
</div>