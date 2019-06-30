<?php

namespace common\models\config;

use Yii;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property int $id
 * @property string $parametro
 * @property string $clavecentro
 */
class Config extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parametro'], 'required'],
            [['parametro'], 'string', 'max' => 40],
            [['clavecentro'], 'string', 'max' => 1],
            [['parametro'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'parametro' => Yii::t('base.names', 'Parametro'),
            'clavecentro' => Yii::t('base.names', 'Clavecentro'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ConfigQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConfigQuery(get_called_class());
    }
}
