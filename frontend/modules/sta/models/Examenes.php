<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_examenes}}".
 *
 * @property int $id
 * @property int $citas_id
 * @property string $codtest
 * @property string $detalles
 *
 * @property StaTest $codtest0
 * @property StaCitas $citas
 */
class Examenes extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_examenes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['citas_id', 'codtest'], 'required'],
            [['citas_id'], 'integer'],
            [['detalles'], 'string'],
            [['codtest'], 'string', 'max' => 8],
            [['codtest'], 'exist', 'skipOnError' => true, 'targetClass' => StaTest::className(), 'targetAttribute' => ['codtest' => 'codtest']],
            [['citas_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaCitas::className(), 'targetAttribute' => ['citas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'citas_id' => Yii::t('sta.labels', 'Citas ID'),
            'codtest' => Yii::t('sta.labels', 'Codtest'),
            'detalles' => Yii::t('sta.labels', 'Detalles'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodtest0()
    {
        return $this->hasOne(StaTest::className(), ['codtest' => 'codtest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitas()
    {
        return $this->hasOne(StaCitas::className(), ['id' => 'citas_id']);
    }

    /**
     * {@inheritdoc}
     * @return ExamenesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExamenesQuery(get_called_class());
    }
}
