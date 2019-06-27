<?php
namespace backend\models\install;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class Settings extends Model
{
   public $companyName;
   public $emailCompany;
   public $rucCompany;
   public $moneda;
   public $serverMail;            
   public $userMail;
   public  $passwordMail;
   public  $portMail;
    /**
     * @inheritdoc
     */
    public function rules()
    {
       // $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
        return [
            [['companyName','emailCompany','rucCompany','moneda','serverMail','userMail','passwordMail','portMail'], 'filter', 'filter' => 'trim'],
            [['companyName','emailCompany','rucCompany','moneda'], 'required','on'=>'company'],
            [['serverMail','userMail','passwordMail','portMail'], 'required', 'on' => 'mail'],
               [['serverMail','userMail','passwordMail','portMail'], 'filter', 'filter' => 'trim'],
            ['userMail', 'email', 'on' => 'mail'],
           
            
          ];
    }
 public function attributeLabels()
    {
        return [
           
            
            'companyName' => Yii::t('install.procedures', 'Company Name'),
            'emailCompany' => Yii::t('install.procedures', 'E-mail Company'),
            'rucCompany' => Yii::t('install.procedures', 'Taxes Code'),
            'moneda' => Yii::t('install.procedures', 'Default Currency'),
            'serverMail' => Yii::t('install.procedures', 'E-mail Server'),
             'userMail' => Yii::t('install.procedures', 'E-mail User'),
            'passwordMail' => Yii::t('install.procedures', 'E-mail Password'),
            'portMail' => Yii::t('install.procedures', 'E-mail Port'),
            // 'portMail' => Yii::t('install.procedures', 'E-mail Port'),
            //'deslarga' => Yii::t('install.procedures', 'Long Text'),
        ];
    }
}
