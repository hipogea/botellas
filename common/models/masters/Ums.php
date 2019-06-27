<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%ums}}".
 *
 * @property string $codum
 * @property string $desum
 * @property string $dimension
 * @property int $escala
 *
 * @property Maestrocompo[] $maestrocompos
 */
class Ums extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ums}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codum','desum'], 'required'],
             [['codum'], 'unique'],
            [['codum'], 'match','pattern'=>'/[A-Z]{1}[A-Za-z0-9]*?/'],
            [['escala'], 'integer'],
            [['codum'], 'string', 'max' => 4],
            [['desum'], 'string', 'max' => 14],
            [['dimension'], 'string', 'max' => 1],
            [['codum'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codum' => Yii::t('base.names', 'Codum'),
            'desum' => Yii::t('base.names', 'Desum'),
            'dimension' => Yii::t('base.names', 'Dimension'),
            'escala' => Yii::t('base.names', 'Escala'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaestrocompos()
    {
        return $this->hasMany(Maestrocompo::className(), ['codum' => 'codum']);
    }

    /**
     * {@inheritdoc}
     * @return UmsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UmsQuery(get_called_class());
    }
}
