<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h4>Inicio</h4>

        <p>En este lugar se colocará un control panel 
        </p>
 <?php var_dump(Yii::$app->user->authTimeout) ?>
<?php var_dump(Yii::$app->user->absoluteAuthTimeout) ?>
    <?php var_dump(Yii::$app->user->enableAutoLogin); ?>           
     </div>

   
</div>
