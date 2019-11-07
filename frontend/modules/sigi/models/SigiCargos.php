<?php

namespace frontend\modules\sigi\models;

use Yii;

/**
 * This is the model class for table "{{%sigi_cargos}}".
 *
 * @property int $id
 * @property string $codcargo
 * @property string $descargo
 * @property string $esegreso
 * @property string $regular
 *
 * @property SigiCargosedificio[] $sigiCargosedificios
 */
class SigiCargos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_cargos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codcargo', 'descargo', 'esegreso', 'regular'], 'required'],
            [['codcargo'], 'string', 'max' => 5],
            [['descargo'], 'string', 'max' => 40],
            [['esegreso', 'regular'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sigi.labels', 'ID'),
            'codcargo' => Yii::t('sigi.labels', 'Codcargo'),
            'descargo' => Yii::t('sigi.labels', 'Descargo'),
            'esegreso' => Yii::t('sigi.labels', 'Esegreso'),
            'regular' => Yii::t('sigi.labels', 'Regular'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSigiCargosedificios()
    {
        return $this->hasMany(SigiCargosedificio::className(), ['cargo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SigiCargosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiCargosQuery(get_called_class());
    }
}
