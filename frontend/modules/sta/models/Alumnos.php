<?php

namespace frontend\modules\sta\models;
use frontend\modules\sta\models\Carreras;
use common\models\Profile;
use Yii;

/**
 * This is the model class for table "{{%sta_alu}}".
 *
 * @property int $id
 * @property int $profile_id
 * @property string $codcar
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property string $fecna
 * @property string $codalu
 * @property string $dni
 * @property string $domicilio
 * @property string $codist
 * @property string $codprov
 * @property string $codep
 * @property string $sexo
 *
 * @property StaCarreras $codcar0
 * @property Profile $profile
 */
class Alumnos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_SOLO='solo';
    public static function tableName()
    {
        return '{{%sta_alu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            [['profile_id', 'codcar', 'ap', 'am', 'nombres', 'fecna', 'dni'], 'required','on'=>''],
            [['profile_id'], 'integer'],
            [['codcar'], 'string', 'max' => 6],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['fecna'], 'string', 'max' => 10],
            [['codalu'], 'string', 'max' => 14],
            [['dni'], 'string', 'max' => 12],
            [['domicilio'], 'string', 'max' => 80],
            [['codist', 'codprov', 'codep'], 'string', 'max' => 3],
            [['sexo'], 'string', 'max' => 1],
            [['codcar'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['codcar' => 'codcar']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SOLO] = ['profile_id'];
       // $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'profile_id' => Yii::t('sta.labels', 'Profile ID'),
            'codcar' => Yii::t('sta.labels', 'Codcar'),
            'ap' => Yii::t('sta.labels', 'Ap'),
            'am' => Yii::t('sta.labels', 'Am'),
            'nombres' => Yii::t('sta.labels', 'Nombres'),
            'fecna' => Yii::t('sta.labels', 'Fecna'),
            'codalu' => Yii::t('sta.labels', 'Codalu'),
            'dni' => Yii::t('sta.labels', 'Dni'),
            'domicilio' => Yii::t('sta.labels', 'Domicilio'),
            'codist' => Yii::t('sta.labels', 'Codist'),
            'codprov' => Yii::t('sta.labels', 'Codprov'),
            'codep' => Yii::t('sta.labels', 'Codep'),
            'sexo' => Yii::t('sta.labels', 'Sexo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodcar0()
    {
        return $this->hasOne(Carreras::className(), ['codcar' => 'codcar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    /**
     * {@inheritdoc}
     * @return AlumnosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AlumnosQuery(get_called_class());
    }
}
