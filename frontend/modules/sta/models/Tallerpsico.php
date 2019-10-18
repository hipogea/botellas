<?php

namespace frontend\modules\sta\models;
use common\models\masters\Trabajadores;
use Yii;

/**
 * This is the model class for table "{{%sta_tallerpsico}}".
 *
 * @property int $id
 * @property int $talleres_id
 * @property string $codtra
 * @property string $calificacion
 *
 * @property StaTalleres $talleres
 */
class Tallerpsico extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_tallerpsico}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['talleres_id', 'codtra'], 'required'],
            [['talleres_id'], 'integer'],
            [['codtra'], 'string', 'max' => 6],
            [['calificacion'], 'string', 'max' => 1],
            [['talleres_id'], 'exist', 'skipOnError' => true, 'targetClass' => Talleres::className(), 'targetAttribute' => ['talleres_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'talleres_id' => Yii::t('sta.labels', 'Talleres ID'),
            'codtra' => Yii::t('sta.labels', 'Codtra'),
            'calificacion' => Yii::t('sta.labels', 'Calificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalleres()
    {
        return $this->hasOne(Talleres::className(), ['id' => 'talleres_id']);
    }

    
    public function getTrabajadores()
    {
        return $this->hasOne(Trabajadores::className(), ['codigotra' => 'codtra']);
    }
    /**
     * {@inheritdoc}
     * @return TallerpsicoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TallerpsicoQuery(get_called_class());
    }
}
