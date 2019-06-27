<?php

namespace common\models\config;
use common\models\base\modelBase;
use common\models\masters\Centros;
use common\models\config\Parametros;
use common\models\Documentos;

use Yii;

/**
 * This is the model class for table "{{%configuracion}}".
 *
 * @property string $id
 * @property string $codcen
 * @property string $codocu
 * @property string $codparam
 * @property string $valor
 *
 * @property Centros $codcen0
 * @property Documentos $codocu0
 * @property Parametros $codparam0
 */
class Configuracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%configuracion}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['codocu', 'codparam'], 'required'],
            [['valor'], 'string'],
            [['codcen'], 'string', 'max' => 4],
            [['codocu'], 'string', 'max' => 2],
            [['codparam'], 'string', 'max' => 5],
            [['codcen'], 'exist', 'skipOnError' => false, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
            [['codocu'], 'exist', 'skipOnError' => false, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
            [['codparam'], 'exist', 'skipOnError' => false, 'targetClass' => Parametros::className(), 'targetAttribute' => ['codparam' => 'codparam']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models.labels', 'ID'),
            'codcen' => Yii::t('models.labels', 'Codcen'),
            'codocu' => Yii::t('models.labels', 'Codocu'),
            'codparam' => Yii::t('models.labels', 'Codparam'),
            'valor' => Yii::t('models.labels', 'Valor'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodcen0()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodocu0()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodparam0()
    {
        return $this->hasOne(Parametros::className(), ['codparam' => 'codparam']);
    }
}
