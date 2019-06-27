<?php
namespace backend\models\install;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class Database extends Model
{
     public $host;
      public  $port;     
       public   $database;
      public     $username;
        public    $password;
        

    /**
     * @inheritdoc
     */
    public function rules()
    {
       // $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
        return [
            [['host','port','database','username','password'], 'filter', 'filter' => 'trim'],
              [['host','port','database','username'], 'required'],
            
            [['host','port','database','username'], 'string', 'min' => 4, 'max' => 255],
            
          ];
    }

    public function attributeLabels()
    {
        return [
            'host' => Yii::t('install.procedures', 'Host or IP server'),
            'port' => Yii::t('install.procedures', 'Port to Database'),
            'database' => Yii::t('install.procedures', 'Name Database'),
            'username' => Yii::t('install.procedures', 'User'),
            'password' => Yii::t('install.procedures', 'Password'),
            //'deslarga' => Yii::t('install.procedures', 'Long Text'),
        ];
    }
    
}
