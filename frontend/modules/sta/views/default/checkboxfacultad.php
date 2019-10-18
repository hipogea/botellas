  <div class="col-xs-12 col-md-8">
      <?=$form->field($userfacultad,"[$i]id")->
 hiddenInput()->label(false) ?>
      
<?=$form->field($userfacultad,"[$i]activa")->
 checkBox(['label'=> \yii\helpers\StringHelper::mb_ucwords(
         strtolower($userfacultad->facultad->desfac))]
         ) ?>
 
</div>
