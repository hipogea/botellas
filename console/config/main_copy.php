<?php
require __DIR__ . '/../../common/config/bootstrap.php';
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        
      
                'migrate' => [
                        'class' =>
                    'yii\console\controllers\MigrateController',
                      'migrationPath'=>null,
                        'migrationNamespaces' => [
                            /*Ojo:
                             * Al aplicar estos namespaces
                             * Todos los archivos de migraciones tienen
                             * que tner declarado su namespace en 
                             * la cabecera de otro modo habra error 
                             * al momento de ejecutar la migracion 
                             */
                          'console\migrations',
                           'nemmo\attachments\migrations', 
                          'yii\rbac\migrations', 
                           'yii2mod\settings\migrations',  
                        // 'nemmo\attachments\migrations',                                                                                 
                         'frontend\modules\people\database\migrations',
                         'frontend\modules\bigitems\database\migrations', 
                            
                            ],
                        ],
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        
        
        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
         'user' => [
       'class' => 'mdm\admin\models\User',
        'identityClass' => 'mdm\admin\models\User',
        'loginUrl' => ['admin/user/login'],
         ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
