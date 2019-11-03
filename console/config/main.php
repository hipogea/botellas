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
        /* 'migrate-app' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => ['console\migrations'],
            //'migrationTable' => 'migration_app',
            'migrationPath' => null,
           ],
        'migrate-attachments' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => ['nemmo\attachments\migrations'],
            //'migrationTable' => 'migration_app',
            'migrationPath' => null,
           ],
        'migrate-rbac' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => ['yii\rbac\migrations'],
            //'migrationTable' => 'migration_app',
            'migrationPath' => null,
           ],
        'migrate-settings' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => ['yii2mod\settings\migrations'],
            //'migrationTable' => 'migration_app',
            'migrationPath' => null,
           ],
         'migrate-admin' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => ['mdm\admin\migrations'],
            //'migrationTable' => 'migration_app',
            'migrationPath' => null,
           ],
        'migrate-people' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => ['frontend\modules\people\database\migrations'],
            //'migrationTable' => 'migration_app',
            'migrationPath' => null,
           ],
        'migrate-bigitems' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => ['frontend\modules\bigitems\database\migrations'],
            //'migrationTable' => 'migration_app',
            'migrationPath' => null,
           ],
        */
        
        
      
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
                         // 'nemmo\attachments\migrations', 
                          //'yii\rbac\migrations', 
                          // 'yii2mod\settings\migrations',  
                        // 'nemmo\attachments\migrations',   
                           // 'mdm\admin\migrations',
                         'frontend\modules\people\database\migrations',
                         'frontend\modules\bigitems\database\migrations', 
                         'frontend\modules\report\database\migrations',
                            'frontend\modules\import\database\migrations',
                            'frontend\modules\sta\database\migrations',
                            'frontend\modules\sigi\database\migrations',
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
                //'traceLevel' => YII_DEBUG ? 3 : 0,            
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['trace','error', 'warning','info'],
                ],
               /* [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'categories' => ['yii\db\*'],
                    'message' => [
                       'from' => ['log@example.com'],
                       'to' => ['admin@example.com', 'developer@example.com'],
                       'subject' => 'Database errors at example.com',
                    ],
                ],*/
            ],
        ],
    ],
    'params' => $params,
];
