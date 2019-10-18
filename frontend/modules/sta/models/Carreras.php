<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_carreras}}".
 *
 * @property string $codcar
 * @property string $codfac
 * @property string $descar
 * @property string $code1
 * @property string $code2
 * @property string $code3
 *
 * @property StaFacultades $codfac0
 */
class Carreras extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_carreras}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codcar', 'codfac', 'descar'], 'required'],
             ['codcar', 'unique'],
            [['codcar', 'code1', 'code2'], 'string', 'max' => 2],
            [['codfac', 'code3'], 'string', 'max' => 8],
            [['descar'], 'string', 'max' => 60],
            [['codcar'], 'unique'],
            [['codfac'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['codfac' => 'codfac']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codcar' => Yii::t('sta.labels', 'Codcar'),
            'codfac' => Yii::t('sta.labels', 'Codfac'),
            'descar' => Yii::t('sta.labels', 'Descar'),
            'code1' => Yii::t('sta.labels', 'Code1'),
            'code2' => Yii::t('sta.labels', 'Code2'),
            'code3' => Yii::t('sta.labels', 'Code3'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['codfac' => 'codfac']);
    }

    /**
     * {@inheritdoc}
     * @return CarrerasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarrerasQuery(get_called_class());
    }
}
