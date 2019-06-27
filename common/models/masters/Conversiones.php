<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%conversiones}}".
 *
 * @property int $id
 * @property string $codum1
 * @property string $codum2
 * @property double $valor1
 * @property double $valor2
 * @property string $codart
 *
 * @property Ums $codum20
 * @property Maestrocompo $codart0
 * @property Ums $codum10
 */
class Conversiones extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%conversiones}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codum1', 'codum2', 'valor1', 'valor2', 'codart'], 'required'],
            [['valor1', 'valor2'], 'number'],
            [['codum1', 'codum2'], 'string', 'max' => 4],
            [['codart'], 'string', 'max' => 14],
            [['codum2'], 'exist', 'skipOnError' => true, 'targetClass' => Ums::className(), 'targetAttribute' => ['codum2' => 'codum']],
            [['codart'], 'exist', 'skipOnError' => true, 'targetClass' => Maestrocompo::className(), 'targetAttribute' => ['codart' => 'codart']],
            [['codum1'], 'exist', 'skipOnError' => true, 'targetClass' => Ums::className(), 'targetAttribute' => ['codum1' => 'codum']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'codum1' => Yii::t('base.names', 'Codum1'),
            'codum2' => Yii::t('base.names', 'Codum2'),
            'valor1' => Yii::t('base.names', 'Valor1'),
            'valor2' => Yii::t('base.names', 'Valor2'),
            'codart' => Yii::t('base.names', 'Codart'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodum20()
    {
        return $this->hasOne(Ums::className(), ['codum' => 'codum2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodart0()
    {
        return $this->hasOne(Maestrocompo::className(), ['codart' => 'codart']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodum10()
    {
        return $this->hasOne(Ums::className(), ['codum' => 'codum1']);
    }

    /**
     * {@inheritdoc}
     * @return ConversionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConversionesQuery(get_called_class());
    }
}
