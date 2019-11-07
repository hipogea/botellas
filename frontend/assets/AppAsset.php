<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
 public $basePath = '@webroot';
    public $baseUrl = '@web';
     public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
       // 'css/app.css',
        'css/site.css',
        'css/personal.css',
        'css/font-awesome.min_1.css',       
        'css/ionicons.min.css',
        'css/akaunting-green.css',
         'css/bootstrap.min.css',
         'css/bootstrap.min.css',
        'css/install.css',
         'css/select2.css',
    ];
    public $js = [
         'js/jquery-ui.js',
         'js/modal.js',
          'js/select2.js',
        
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}
