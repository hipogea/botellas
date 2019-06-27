<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'language'=>'es_PE',
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        
         'urlManager' => [ //yii\web\UrlManager
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
               
            ],
        ],
        
       'view' => [ //yii\base\View|yii\web\View
         'theme' => [
             'pathMap' => [
                '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app-backend'
             ],
         ],
          ],
        
        'assetManager'=>[ //yii\web\AssetManager
               'bundles'=>[
                   'dmstr\web\AdminLteAsset'=>['skin'=>'skin-blue'],
                             ],
                        ],
        
        
        
        
        
        'request' => [ //yii\web\Request
            'csrfParam' => '_csrf-backend',
        ],
        
       
        
        
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],*/
        'session' => [//yii\web\Session
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        
        
        'log' => [ //yii\log\Dispatcher
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [//yii\web\ErrorHandler
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
                            
];
