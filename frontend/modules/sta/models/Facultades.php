<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_facultades}}".
 *
 * @property string $codfac
 * @property string $desfac
 * @property string $code1
 * @property string $code2
 * @property string $code3
 *
 * @property StaCarreras[] $staCarreras
 */
class Facultades extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_facultades}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codfac', 'desfac'], 'required'],
            [['codfac', 'code3'], 'string', 'max' => 3],
            [['desfac'], 'string', 'max' => 60],
            [['code1', 'code2'], 'string', 'max' => 2],
            [['codfac'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codfac' => Yii::t('sta.labels', 'Codfac'),
            'desfac' => Yii::t('sta.labels', 'Desfac'),
            'code1' => Yii::t('sta.labels', 'Code1'),
            'code2' => Yii::t('sta.labels', 'Code2'),
            'code3' => Yii::t('sta.labels', 'Code3'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaCarreras()
    {
        return $this->hasMany(StaCarreras::className(), ['codfac' => 'codfac']);
    }

    /**
     * {@inheritdoc}
     * @return FacultadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FacultadesQuery(get_called_class());
    }
}
