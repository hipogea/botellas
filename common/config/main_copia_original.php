<?php
return [
   'name'=>'Nautilus',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    
   /*'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/login*',  
             'site/logout*', 
        ]
    ],*/
    
    
   
    
    
    'modules' => [
        
       
        
        'gridview' =>  [
        'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
        ],
        
        'attachments' => [
		'class' => nemmo\attachments\Module::className(),
		'tempPath' => '@common/uploads/temp',
		'storePath' => '@common/uploads/store',
		'rules' => [ // Rules according to the FileValidator
		    'maxFiles' => 10, // Allow to upload maximum 3 files, default to 3
		//'mimeTypes' => 'image/png', // Only png images
			'maxSize' => 10  // 1 MB
		],
		'tableName' => '{{%attachments}}' // Optional, default to 'attach_file'
	],
        
        
        
        
    'admin' => [
                'class' => 'mdm\admin\Module',        
                ],
   
        'settings' => [
        'class' => 'yii2mod\settings\Module',
           //'cache' => 'yii\caching\Cache',//yii\caching\Cache
            ],
        
        'reportico' => [
            'class' => 'reportico\reportico\Module' ,
            'controllerMap' => [
                
                
                            'reportico' => 'reportico\reportico\controllers\ReporticoController',
                            'mode' => 'reportico\reportico\controllers\ModeController',
                            //'ajax' => 'reportico\reportico\controllers\AjaxController',
                        ]
            ],
        
        
        
        
           ],
    
    'components' => [
           
         'request' => [

        	// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation

        	'cookieValidationKey' => 'HOLIS',

        	'enableCsrfValidation' => false,

    ],

        
        
        
         'assetManager' => [
        'bundles' => [
            
            'kartik\form\ActiveFormAsset' => [
                'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
          
                                 ],
            'yii\web\JqueryAsset' => [
                'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
            ],
            'yii\widgets\PjaxAsset' => [
                'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
            ],
        ],
    ],
        
        
        
        
         'i18n' => [
            'translations' => [
                        'yii2mod.settings' => [
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            'basePath' => '@yii2mod/settings/messages',
                                            ],                
                
                'install.procedures' =>[
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            'basePath' => '@messages',                                            
                                            ],
                
                                     'models.validations' =>[
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            'basePath' => '@messages',                                            
                                            ],
                                      'models.labels' =>[
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            'basePath' => '@messages',                                          
                                            ],                
                                     'models.errors' =>[
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            'basePath' => '@messages',
                                           
                                            //'basePath' => '@app/messages',                                            
                                            ],
                                        'control.errors' =>[
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            'basePath' => '@messages',                                          
                                            ],
                
                                    'base.errors' =>[
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            'basePath' => '@messages',                                          
                                            ],
                             'base.names'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@messages',                                          
                                            ], 
                'base.forms'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@messages',                                          
                                            ], 
                
                                   'base.actions'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@messages',                                          
                                            ], 
                                         'base.errors'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@messages',                                          
                                            ], 
                                            'base.verbs'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@messages',                                          
                                            ], 
                
                      ],
                  ],
        
   'settings' => [
        'class' => 'yii2mod\settings\components\Settings',
        'cache'=>['class'=>'yii\caching\FileCache'],
    ],
        
        
    'authManager' => [
         'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
    ],
        'user' => [
         'class' => 'common\components\User',
        'identityClass' => 'mdm\admin\models\User',
        //'loginUrl' => ['admin/user/login'],
         'loginUrl' => ['site/login'],  
           'enableAutoLogin'=>false,
            'enableSession' => true,
           // 'authTimeout'=>1,
    ]
        
        
        
           ],
    
    
    
];
