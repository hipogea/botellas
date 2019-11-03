<?php 
 return [ 'name'=>'Nautilus',
'components' =>['mailer' =>['class'=>'common\components\Mailer',
'viewPath'=>'@common/mail',
],
'settings' =>['class'=>'yii2mod\settings\components\Settings',
],
'db' =>['class'=>'yii\db\Connection',
'dsn'=>'mysql:host=localhost; port=3306;dbname=wwwcase_db',
'username'=>'wwwcase_db',
'password'=>'RNbSJQz',
'charset'=>'utf8',
'tablePrefix'=>'7av4v_',
],
],
'language'=>'es',
     
];  ?>