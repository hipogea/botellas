<?php

namespace frontend\modules\sigi\models;

use Yii;

/**
 * This is the model class for table "{{%sigi_suministros}}".
 *
 * @property int $id
 * @property string $tipo
 * @property string $codpro
 * @property string $codsuministro
 * @property string $numerocliente
 * @property string $codum
 * @property int $unidad_id
 * @property string $detalles
 * @property int $frecuencia
 *
 * @property Ums $codum0
 * @property SigiUnidades $unidad
 * @property Clipro $codpro0
 */
class SigiSuministros extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_suministros}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'codpro', 'codum', 'unidad_id'], 'required'],
            [['unidad_id', 'frecuencia'], 'integer'],
            [['detalles'], 'string'],
            [['tipo'], 'string', 'max' => 3],
            [['codpro'], 'string', 'max' => 6],
            [['codsuministro'], 'string', 'max' => 12],
            [['numerocliente'], 'string', 'max' => 25],
            [['codum'], 'string', 'max' => 4],
            [['codum'], 'exist', 'skipOnError' => true, 'targetClass' => Ums::className(), 'targetAttribute' => ['codum' => 'codum']],
            [['unidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => SigiUnidades::className(), 'targetAttribute' => ['unidad_id' => 'id']],
            [['codpro'], 'exist', 'skipOnError' => true, 'targetClass' => Clipro::className(), 'targetAttribute' => ['codpro' => 'codpro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sigi.labels', 'ID'),
            'tipo' => Yii::t('sigi.labels', 'Tipo'),
            'codpro' => Yii::t('sigi.labels', 'Codpro'),
            'codsuministro' => Yii::t('sigi.labels', 'Codsuministro'),
            'numerocliente' => Yii::t('sigi.labels', 'Numerocliente'),
            'codum' => Yii::t('sigi.labels', 'Codum'),
            'unidad_id' => Yii::t('sigi.labels', 'Unidad ID'),
            'detalles' => Yii::t('sigi.labels', 'Detalles'),
            'frecuencia' => Yii::t('sigi.labels', 'Frecuencia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodum0()
    {
        return $this->hasOne(Ums::className(), ['codum' => 'codum']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidad()
    {
        return $this->hasOne(SigiUnidades::className(), ['id' => 'unidad_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodpro0()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro']);
    }

    /**
     * {@inheritdoc}
     * @return SigiSuministrosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiSuministrosQuery(get_called_class());
    }
}
