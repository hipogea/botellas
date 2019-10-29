<?php

namespace frontend\modules\sta\models;
use frontend\modules\sta\components\ActiveQueryScope;
use Yii;

/**
 * This is the model class for table "{{%sta_aluriesgo}}".
 *
 * @property int $id
 * @property int $entrega_id
 * @property string $codcur
 * @property string $codalu
 * @property int $nveces
 *
 * @property StaAlu $codalu0
 * @property StaMaterias $codcur0
 */
class Aluriesgo extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_aluriesgo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entrega_id', 'nveces'], 'integer'],
             
             //[['descripcion'], 'string', 'max' => 40],
            [['codperiodo','entrega_id','codcur','codalu','nveces'],'required','on'=>'import'],
           ['codperiodo', 'unique', 'targetAttribute' => 
                 ['codalu','codcar','codcur', 'codperiodo'],
              'message'=>yii::t('sta.errors',
                      'Esta combinacion de valores {codalu}-{codcur}-{codperiodo}-{codcar} ya existe',
                      ['codalu'=>$this->getAttributeLabel('codalu'),
                        'codcur'=>$this->getAttributeLabel('codcur'),
                          'codperiodo'=>$this->getAttributeLabel('codperiodo'),
                          'codcar'=>$this->getAttributeLabel('codcar')]
                      )],
            [['codcur'], 'string', 'max' => 10],
            [['codalu'], 'string', 'max' => 14],
            [['codalu'], 'exist', 'skipOnError' => true,'message'=>'no exiset alu', 'targetClass' => Alumnos::className(), 'targetAttribute' => ['codalu' => 'codalu']],
            [['codcur'], 'exist', 'skipOnError' => true, 'message'=>'no exiset mate','targetClass' => Materias::className(), 'targetAttribute' => ['codcur' => 'codcur']],
        [['codperiodo'], 'exist', 'skipOnError' => true,'message'=>'no exiset periodo', 'targetClass' => Periodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
            [['codcar'], 'exist', 'skipOnError' => true, 'message'=>'no exiset carerra','targetClass' => Carreras::className(), 'targetAttribute' => ['codcar' => 'codcar']],
            ];
    }

     public function scenarios()
    {
        $scenarios = parent::scenarios(); 
        $scenarios['import'] = ['codperiodo','entrega_id','nveces','codcur','codalu'];
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
            'entrega_id' => Yii::t('sta.labels', 'Entrega ID'),
            'codcur' => Yii::t('sta.labels', 'Codcur'),
            'codalu' => Yii::t('sta.labels', 'Codalu'),
            'nveces' => Yii::t('sta.labels', 'Nveces'),
        ];
    }

   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumno()
    {
        return $this->hasOne(Alumnos::className(), ['codalu' => 'codalu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMateria()
    {
        return $this->hasOne(Materias::className(), ['codcur' => 'codcur']);
    }
    
    
    
    public function getPeriodo()
    {
        return $this->hasOne(Periodos::className(), ['codperiodo' => 'codperiodo']);
    }
    public function getCarrera()
    {
        return $this->hasOne(Carreras::className(), ['codcar' => 'codcar']);
    }

    /**
     * {@inheritdoc}
     * @return AluriesgoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AluriesgoQuery(get_called_class());
    }
    /*
     * Devuelve toodos los alumnos 
     * Ojo que al ser hereadad de activequeryScope
     * devuelve los registros filtrados por facultad
     * segun los roles
   
     */
    public static function studentsInRisk($returnarray=true){
        if($returnarray)
       return $this->studentsInRiskQuery()->asArray()->all();
       return $this->studentsInRiskQuery()->all(); 
    }
    
    /*
     * Devuelve toodos los alumnos 
     * Ojo que al ser hereadad de activequeryScope
     * devuelve los registros filtrados por facultad
     * segun los roles
   
     */
    public static function studentsInRiskQuery(){
       //return static::find()->select('codalu','codperiodo')->distinct(); 
        $query = static::find()->select([Aluriesgo::tableName().'.codalu','codperiodo'])
                ->distinct()->innerJoin(Alumnos::tableName(), Aluriesgo::tableName().'.codalu='. Alumnos::tableName().'.codalu');
                
        return $query;
    }
}
