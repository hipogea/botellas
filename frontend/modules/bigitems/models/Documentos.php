<?php

namespace frontend\modules\bigitems\models;

use Yii;

/**
 * This is the model class for table "{{%documentos}}".
 *
 * @property string $codocu
 * @property string $desdocu
 * @property string $clase
 * @property string $tipo
 * @property string $tabla
 * @property string $abreviatura
 * @property string $prefijo
 * @property string $escomprobante Define si es un comprobante 
 * @property int $idreportedefault Indica el id del reporte por defaul, sirve para visualizar un documento 
 *
 * @property Activos[] $activos
 * @property Configuracion[] $configuracions
 */
class Documentos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%documentos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codocu', 'desdocu'], 'required'],
            [['idreportedefault'], 'integer'],
            [['codocu'], 'string', 'max' => 3],
            [['desdocu', 'tabla'], 'string', 'max' => 60],
            [['clase', 'escomprobante'], 'string', 'max' => 1],
            [['tipo'], 'string', 'max' => 2],
            [['abreviatura'], 'string', 'max' => 5],
            [['prefijo'], 'string', 'max' => 4],
            [['codocu'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codocu' => 'Codocu',
            'desdocu' => 'Desdocu',
            'clase' => 'Clase',
            'tipo' => 'Tipo',
            'tabla' => 'Tabla',
            'abreviatura' => 'Abreviatura',
            'prefijo' => 'Prefijo',
            'escomprobante' => 'Escomprobante',
            'idreportedefault' => 'Idreportedefault',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivos()
    {
        return $this->hasMany(Activos::className(), ['codocu' => 'codocu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfiguracions()
    {
        return $this->hasMany(Configuracion::className(), ['codocu' => 'codocu']);
    }

    /**
     * {@inheritdoc}
     * @return DocumentosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocumentosQuery(get_called_class());
    }
}
