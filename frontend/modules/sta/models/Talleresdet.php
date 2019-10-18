<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_talleresdet}}".
 *
 * @property int $id
 * @property int $talleres_id
 * @property string $codalu
 * @property string $fingreso
 * @property string $detalles
 * @property string $codtra
 *
 * @property StaTalleres $talleres
 * @property StaAlu $codalu0
 */
class Talleresdet extends \common\models\base\modelBase
{
    
    const SCENARIO_BATCH='batch';
    const SCENARIO_PSICO='psico';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_talleresdet}}';
    }

     public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_BATCH] = ['talleres_id','codalu'];
        $scenarios[self::SCENARIO_PSICO] = ['codtra_psico'];
       // $scenarios[self::SCENARIO_BATCH] = [ 'codcar', 'ap', 'am', 'nombres', 'dni','domicilio','correo','celulares','fijos'];
       // $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['talleres_id', 'codalu'], 'required'],
            [['talleres_id'], 'integer'],
            [['detalles'], 'string'],
            [['codalu'], 'string', 'max' => 14],
            [['fingreso'], 'string', 'max' => 10],
            [['codtra'], 'string', 'max' => 6],
            [['talleres_id'], 'exist', 'skipOnError' => true, 'targetClass' => Talleres::className(), 'targetAttribute' => ['talleres_id' => 'id']],
            [['codalu'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::className(), 'targetAttribute' => ['codalu' => 'codalu']],
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
            'codalu' => Yii::t('sta.labels', 'Codalu'),
            'fingreso' => Yii::t('sta.labels', 'Fingreso'),
            'detalles' => Yii::t('sta.labels', 'Detalles'),
            'codtra' => Yii::t('sta.labels', 'Codtra'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getAlumno()
    {
        return $this->hasOne(Alu::className(), ['codalu' => 'codalu']);
    }

    /**
     * {@inheritdoc}
     * @return TalleresdetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TalleresdetQuery(get_called_class());
    }
}
