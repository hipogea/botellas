<?php

namespace frontend\modules\sigi;
use common\helpers\h;
USE \yii2mod\settings\models\enumerables\SettingType;
/**
 * people module definition class
 */
class Module extends \yii\base\Module
{
    
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\sigi\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        static::putSettingsModule();

        // custom initialization code goes here
    }
      private static function putSettingsModule(){
      //  h::getIfNotPutSetting('sigi','','.jpg', SettingType::STRING_TYPE);
       //  h::getIfNotPutSetting('sigi','urlimagesalu','http:://www.orce.uni.edu.pe/alumnos/', SettingType::STRING_TYPE);
        // h::getIfNotPutSetting('sigi','prefiximagesalu','0060', SettingType::STRING_TYPE);
          return true;
    }
}
