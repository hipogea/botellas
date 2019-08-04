<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_aulas}}".
 *
 * @property int $id
 * @property string $codaula
 * @property string $codfac
 * @property string $pabellon
 * @property int $cap
 *
 * @property StaFacultades $codfac0
 */
class Aulas extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_aulas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cap'], 'integer'],
            [['codaula'], 'string', 'max' => 12],
            [['codfac'], 'string', 'max' => 6],
            [['pabellon'], 'string', 'max' => 40],
            [['codfac'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['codfac' => 'codfac']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'codaula' => Yii::t('sta.labels', 'Codaula'),
            'codfac' => Yii::t('sta.labels', 'Codfac'),
            'pabellon' => Yii::t('sta.labels', 'Pabellon'),
            'cap' => Yii::t('sta.labels', 'Cap'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodfac0()
    {
        return $this->hasOne(Facultades::className(), ['codfac' => 'codfac']);
    }

    /**
     * {@inheritdoc}
     * @return AulasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AulasQuery(get_called_class());
    }
}
