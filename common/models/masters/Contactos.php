<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%contactos}}".
 *
 * @property int $id
 * @property string $nombres
 * @property string $moviles
 * @property string $mail
 * @property string $mail1
 * @property string $codpro
 *
 * @property Clipro $codpro0
 */
class Contactos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contactos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['nombres','codpro'], 'required'],
             ['codpro','safe'],
            [['nombres'], 'string', 'max' => 60],
            [['moviles', 'mail1'], 'string', 'max' => 30],
            [['mail'], 'string', 'max' => 25],
            [['codpro'], 'string', 'max' => 6],
            [['codpro'], 'exist', 'skipOnError' => true, 'targetClass' => Clipro::className(), 'targetAttribute' => ['codpro' => 'codpro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'nombres' => Yii::t('base.names', 'Nombres'),
            'moviles' => Yii::t('base.names', 'Moviles'),
            'mail' => Yii::t('base.names', 'Mail'),
            'mail1' => Yii::t('base.names', 'Mail1'),
            'codpro' => Yii::t('base.names', 'Codpro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodpro0()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro']);
    }

    /**
     * {@inheritdoc}
     * @return ContactosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactosQuery(get_called_class());
    }
}
