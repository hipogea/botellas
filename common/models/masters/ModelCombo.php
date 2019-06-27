<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property int $id
 * @property string $parametro
 * @property string $clavecentro
 */
class ModelCombo extends \common\models\base\modelBase
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
            [['parametro'], 'string', 'max' => 40],
            [['clavecentro'], 'string', 'max' => 1],
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
     * @return ModelComboQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModelComboQuery(get_called_class());
    }
}
