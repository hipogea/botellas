<?php

namespace frontend\modules\bigitems\models;

use Yii;

/**
 * This is the model class for table "{{%logtransporte}}".
 *
 * @property int $id
 * @property int $activo_id
 * @property string $codestado
 * @property int $lugar_id
 * @property string $fecha
 * @property string $fechadoc
 * @property string $codocu
 * @property string $numdoc
 * @property int $lugar_anterior_id
 * @property string $time
 * @property int $user_id
 *
 * @property Lugares $lugar
 * @property Lugares $lugarAnterior
 * @property Activos $activo
 */
class LogTransporte extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%logtransporte}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activo_id', 'lugar_id', 'lugar_anterior_id', 'user_id'], 'integer'],
            [['codestado'], 'string', 'max' => 2],
            [['fecha', 'fechadoc'], 'string', 'max' => 10],
            [['codocu'], 'string', 'max' => 1],
            [['numdoc'], 'string', 'max' => 20],
            [['time'], 'string', 'max' => 18],
            [['lugar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lugares::className(), 'targetAttribute' => ['lugar_id' => 'id']],
            [['lugar_anterior_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lugares::className(), 'targetAttribute' => ['lugar_anterior_id' => 'id']],
            [['activo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activos::className(), 'targetAttribute' => ['activo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activo_id' => 'Activo ID',
            'codestado' => 'Codestado',
            'lugar_id' => 'Lugar ID',
            'fecha' => 'Fecha',
            'fechadoc' => 'Fechadoc',
            'codocu' => 'Codocu',
            'numdoc' => 'Numdoc',
            'lugar_anterior_id' => 'Lugar Anterior ID',
            'time' => 'Time',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugar()
    {
        return $this->hasOne(Lugares::className(), ['id' => 'lugar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugarAnterior()
    {
        return $this->hasOne(Lugares::className(), ['id' => 'lugar_anterior_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivo()
    {
        return $this->hasOne(Activos::className(), ['id' => 'activo_id']);
    }

    /**
     * {@inheritdoc}
     * @return LogTransporteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogTransporteQuery(get_called_class());
    }
}
