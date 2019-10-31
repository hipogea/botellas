<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_rangos}}".
 *
 * @property int $id
 * @property int $talleres_id
 * @property int $dia
 * @property string $hinicio
 * @property string $hfin
 * @property int $tolerancia
 *
 * @property StaTalleres $talleres
 */
class Rangos extends \common\models\base\modelBase
{
   
    public $booleanFields=['activo'];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_rangos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['talleres_id', 'dia', 'hinicio', 'hfin', 'tolerancia','nombredia'], 'required'],
            [['talleres_id', 'dia'], 'integer'],
            [['nombredia','activo'], 'safe'],
            [['hinicio', 'hfin'], 'string', 'max' => 5],
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
            'dia' => Yii::t('sta.labels', 'Dia'),
            'hinicio' => Yii::t('sta.labels', 'Hinicio'),
            'hfin' => Yii::t('sta.labels', 'Hfin'),
            'tolerancia' => Yii::t('sta.labels', 'Tolerancia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalleres()
    {
        return $this->hasOne(Talleres::className(), ['id' => 'talleres_id']);
    }

    /**
     * {@inheritdoc}
     * @return RangosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RangosQuery(get_called_class());
    }
    
    
}
