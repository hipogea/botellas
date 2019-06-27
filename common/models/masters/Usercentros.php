<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%usercentros}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $codcen
 *
 * @property User $user
 * @property Centros $codcen0
 */
class Usercentros extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%usercentros}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'codcen'], 'required'],
            [['user_id'], 'integer'],
            [['codcen'], 'string', 'max' => 5],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'user_id' => Yii::t('base.names', 'User ID'),
            'codcen' => Yii::t('base.names', 'Codcen'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodcen0()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * {@inheritdoc}
     * @return UsercentrosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsercentrosQuery(get_called_class());
    }
}
