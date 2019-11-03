<?php

namespace frontend\modules\sigi\models;
use common\models\masters\Trabajadores;
use common\models\masters\Centros;
use Yii;

/**
 * This is the model class for table "{{%sigi_edificios}}".
 *
 * @property int $id
 * @property string $codtra
 * @property string $nombre
 * @property string $latitud
 * @property string $meridiano
 * @property string $proyectista
 * @property string $tipo
 * @property int $npisos
 * @property string $detalles
 * @property string $codcen
 * @property string $direccion
 * @property string $coddepa
 * @property string $codprov
 *
 * @property Trabajadores $codtra0
 * @property Centros $codcen0
 */
class Edificios extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_edificios}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codtra', 'nombre', 'tipo', 'npisos', 'codcen', 'direccion', 'coddepa', 'codprov'], 'required'],
            [['npisos'], 'integer'],
            [['coddist'], 'safe'],
            [['detalles'], 'string'],
            [['codtra', 'codprov'], 'string', 'max' => 6],
            [['nombre', 'proyectista'], 'string', 'max' => 60],
            [['latitud', 'meridiano'], 'string', 'max' => 16],
            [['tipo'], 'string', 'max' => 3],
            [['codcen'], 'string', 'max' => 5],
            [['direccion'], 'string', 'max' => 100],
            [['coddepa'], 'string', 'max' => 9],
            [['codtra'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajadores::className(), 'targetAttribute' => ['codtra' => 'codigotra']],
            [['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sigi.labels', 'ID'),
            'codtra' => Yii::t('sigi.labels', 'Administrador'),
            'nombre' => Yii::t('sigi.labels', 'Nombre'),
            'latitud' => Yii::t('sigi.labels', 'Latitud'),
            'meridiano' => Yii::t('sigi.labels', 'Meridiano'),
            'proyectista' => Yii::t('sigi.labels', 'Proyectista'),
            'tipo' => Yii::t('sigi.labels', 'Tipo Unidad'),
            'npisos' => Yii::t('sigi.labels', 'Niveles'),
            'detalles' => Yii::t('sigi.labels', 'Detalles'),
            'codcen' => Yii::t('sigi.labels', 'Centro'),
            'direccion' => Yii::t('sigi.labels', 'Dirección'),
            'coddepa' => Yii::t('sigi.labels', 'Departamento'),
            'codprov' => Yii::t('sigi.labels', 'Provincia'),
             'coddist' => Yii::t('sigi.labels', 'Distrito'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajador()
    {
        return $this->hasOne(Trabajadores::className(), ['codigotra' => 'codtra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentro()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * {@inheritdoc}
     * @return EdificiosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EdificiosQuery(get_called_class());
    }
}
