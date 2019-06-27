<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
 public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/app.css',
        'css/site.css',
        'css/font-awesome.min.css',       
        'css/ionicons.min.css',
        'css/akaunting-green.css',
         'css/bootstrap.min.css',
    ];
    public $js = [
         'js/modal.js',
    ];
    public $depends = [
       // 'yii\web\YiiAsset',
       // 'yii\bootstrap\BootstrapAsset',
    ];
}
