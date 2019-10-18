<?php

namespace frontend\modules\import\models;

use Yii;

/**
 * This is the model class for table "{{%import_logcargamasiva}}".
 *
 * @property int $id
 * @property int $cargamasiva_id
 * @property string $nombrecampo
 * @property string $mensaje
 * @property string $level
 * @property string $fecha
 * @property int $user_id
 * @property int $numerolinea
 *
 * @property ImportCargamasiva $cargamasiva
 */
class ImportLogcargamasiva extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%import_logcargamasiva}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'cargamasiva_id', 'nombrecampo', 'mensaje', 'user_id', 'numerolinea'], 'required'],
            [['id', 'cargamasiva_id', 'user_id', 'numerolinea'], 'integer'],
            [['nombrecampo'], 'string', 'max' => 60],
            [['mensaje'], 'string', 'max' => 80],
            [['level'], 'string', 'max' => 1],
           // [['fecha'], 'string', 'max' => 18],
            [['cargamasiva_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportCargamasiva::className(), 'targetAttribute' => ['cargamasiva_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('import.labels', 'ID'),
            'cargamasiva_id' => Yii::t('import.labels', 'Cargamasiva ID'),
            'nombrecampo' => Yii::t('import.labels', 'Nombrecampo'),
            'mensaje' => Yii::t('import.labels', 'Mensaje'),
            'level' => Yii::t('import.labels', 'Level'),
            'fecha' => Yii::t('import.labels', 'Fecha'),
            'user_id' => Yii::t('import.labels', 'User ID'),
            'numerolinea' => Yii::t('import.labels', 'Numerolinea'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargamasiva()
    {
        return $this->hasOne(ImportCargamasiva::className(), ['id' => 'cargamasiva_id']);
    }

    /**
     * {@inheritdoc}
     * @return ImportLogcargamasivaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImportLogcargamasivaQuery(get_called_class());
    }
}
