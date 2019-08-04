<?php
use yii\helpers\Html;
use frontend\modules\report\assets\ReportAsset;
      ?>
<?php  ReportAsset::register($this);   ?>
 <?php $this->beginPage() ?>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <?php //$this->registerCssFile(\Yii\helpers\Url::base()."/report/web/report.css", []); ?>
        <?php $this->head() ?>
    </head>
   <body style="overflow-y: scroll;">
     <?php $this->beginBody(); ?>
    <div>
 <?= $content ?>
            
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>


       
       
       
       
       
       