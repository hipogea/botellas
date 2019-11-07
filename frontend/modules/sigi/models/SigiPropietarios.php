<?php

namespace frontend\modules\sigi\models;

use Yii;

/**
 * This is the model class for table "{{%sigi_propietarios}}".
 *
 * @property int $id
 * @property int $unidad_id
 * @property string $tipo
 * @property string $correo
 * @property string $correo1
 * @property string $correo2
 * @property string $celulares
 * @property string $fijo
 * @property string $dni
 * @property string $participacion
 * @property string $detalle
 * @property string $activo
 * @property string $finicio
 * @property string $fcese
 *
 * @property SigiUnidades $unidad
 */
class SigiPropietarios extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_propietarios}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unidad_id', 'tipo'], 'required'],
            [['unidad_id'], 'integer'],
            [['participacion'], 'number'],
            [['detalle'], 'string'],
            [['tipo', 'activo'], 'string', 'max' => 1],
            [['correo', 'correo1', 'correo2', 'celulares'], 'string', 'max' => 70],
            [['fijo', 'dni'], 'string', 'max' => 12],
            [['finicio', 'fcese'], 'string', 'max' => 10],
            [['unidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => SigiUnidades::className(), 'targetAttribute' => ['unidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sigi.labels', 'ID'),
            'unidad_id' => Yii::t('sigi.labels', 'Unidad ID'),
            'tipo' => Yii::t('sigi.labels', 'Tipo'),
            'correo' => Yii::t('sigi.labels', 'Correo'),
            'correo1' => Yii::t('sigi.labels', 'Correo1'),
            'correo2' => Yii::t('sigi.labels', 'Correo2'),
            'celulares' => Yii::t('sigi.labels', 'Celulares'),
            'fijo' => Yii::t('sigi.labels', 'Fijo'),
            'dni' => Yii::t('sigi.labels', 'Dni'),
            'participacion' => Yii::t('sigi.labels', 'Participacion'),
            'detalle' => Yii::t('sigi.labels', 'Detalle'),
            'activo' => Yii::t('sigi.labels', 'Activo'),
            'finicio' => Yii::t('sigi.labels', 'Finicio'),
            'fcese' => Yii::t('sigi.labels', 'Fcese'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidad()
    {
        return $this->hasOne(SigiUnidades::className(), ['id' => 'unidad_id']);
    }

    /**
     * {@inheritdoc}
     * @return SigiPropietariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiPropietariosQuery(get_called_class());
    }
}
