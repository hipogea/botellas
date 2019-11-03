<?php

namespace frontend\modules\sigi\models;

use Yii;

/**
 * This is the model class for table "{{%sigi_tipounidad}}".
 *
 * @property string $codtipo
 * @property string $desunidad
 * @property string $escomun
 *
 * @property SigiUnidades[] $sigiUnidades
 */
class SigiTipoUnidades extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_tipounidad}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codtipo', 'desunidad', 'escomun'], 'required'],
            [['codtipo'], 'string', 'max' => 4],
            [['desunidad'], 'string', 'max' => 40],
            [['escomun'], 'string', 'max' => 1],
            [['codtipo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codtipo' => Yii::t('sigi.labels', 'Codtipo'),
            'desunidad' => Yii::t('sigi.labels', 'Desunidad'),
            'escomun' => Yii::t('sigi.labels', 'Escomun'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSigiUnidades()
    {
        return $this->hasMany(SigiUnidades::className(), ['codtipo' => 'codtipo']);
    }

    /**
     * {@inheritdoc}
     * @return SigiTipoUnidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiTipoUnidadesQuery(get_called_class());
    }
}
