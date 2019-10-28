<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="alert alert-warning">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    
    <p>
      <?=yii::t('base.errors','El error indicado líneas arriba. Se produjo en el servidor, al momento de intentar acceder a esta dirección')?>
       Sin embargo, Puedes  <a href='<?= Yii::$app->homeUrl ?>'>regresar a la página de inicio</a> 
</div>


