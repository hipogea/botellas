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
            [['codfac', 'code3'], 'string', 'max' => 6],
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
            'codfac' => Yii::t('base.names', 'Codigo'),
            'desfac' => Yii::t('base.names', 'Nombre'),
           
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarreras()
    {
        return $this->hasMany(Carreras::className(), ['codfac' => 'codfac']);
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
