<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_testtalleres}}".
 *
 * @property int $id
 * @property int $taller_id
 * @property string $codtest
 * @property int $peso
 * @property string $obligatorio
 *
 * @property StaTalleres $taller
 */
class StaTestTalleres extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_testtalleres}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taller_id', 'codtest'], 'required'],
            [['taller_id', 'peso'], 'integer'],
            [['codtest'], 'string', 'max' => 8],
            [['obligatorio'], 'string', 'max' => 1],
            [['taller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Talleres::className(), 'targetAttribute' => ['taller_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sigi.labels', 'ID'),
            'taller_id' => Yii::t('sigi.labels', 'Taller ID'),
            'codtest' => Yii::t('sigi.labels', 'Codtest'),
            'peso' => Yii::t('sigi.labels', 'Peso'),
            'obligatorio' => Yii::t('sigi.labels', 'Obligatorio'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaller()
    {
        return $this->hasOne(Talleres::className(), ['id' => 'taller_id']);
    }
     public function getTest()
    {
        return $this->hasOne(Test::className(), ['codtest' => 'codtest']);
    }

    /**
     * {@inheritdoc}
     * @return StaTestTalleresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaTestTalleresQuery(get_called_class());
    }
}
