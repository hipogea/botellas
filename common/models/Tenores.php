<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tenores}}".
 *
 * @property int $id
 * @property string $codocu
 * @property string $activo
 * @property string $posic
 * @property string $texto
 * @property int $order
 *
 * @property Documentos $codocu0
 */
class Tenores extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tenores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codocu'], 'required'],
            [['texto'], 'string'],
            [['order'], 'integer'],
            [['codocu'], 'string', 'max' => 3],
            [['activo', 'posic'], 'string', 'max' => 1],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'codocu' => Yii::t('base.names', 'Codocu'),
            'activo' => Yii::t('base.names', 'Activo'),
            'posic' => Yii::t('base.names', 'Posic'),
            'texto' => Yii::t('base.names', 'Texto'),
            'order' => Yii::t('base.names', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodocu0()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
    }

    /**
     * {@inheritdoc}
     * @return TenoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TenoresQuery(get_called_class());
    }
}
