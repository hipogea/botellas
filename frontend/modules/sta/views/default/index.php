
<?php if (Yii::$app->session->hasFlash('info')): ?>
    <div class="alert alert-warning">
         
         <?= Yii::$app->session->getFlash('info') ?>
    </div>
<?php endif; ?>

<p> hola bienvenidos </p>

