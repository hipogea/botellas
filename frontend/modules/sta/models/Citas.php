<?php

namespace frontend\modules\sta\models;
use common\traits\timeTrait;
use Yii;

/**
 * This is the model class for table "{{%sta_citas}}".
 *
 * @property int $id
 * @property int $talleresdet_id
 * @property int $talleres_id
 * @property string $fechaprog
 * @property string $codtra
 * @property string $finicio
 * @property string $ftermino
 * @property string $fingreso
 * @property string $detalles
 * @property string $codaula
 * @property int $nalumnos
 * @property string $fregistro
 * @property string $calificacion
 *
 * @property StaTalleresdet $talleresdet
 * @property StaTalleres $talleres
 * @property Trabajadores $codtra0
 * @property StaExamenes[] $staExamenes
 */
class Citas extends \common\models\base\modelBase
{
    
    use timeTrait;
    public $dateorTimeFields=[
        'fechaprog'=>self::_FDATETIME,
         'finicio'=>self::_FDATETIME,
        'ftermino'=>self::_FDATETIME
    ];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_citas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['talleresdet_id', 'talleres_id', 'codtra', 'fregistro'], 'required'],
            [['talleresdet_id', 'talleres_id', 'nalumnos','duracion'], 'integer'],
            [['detalles'], 'string'],
             [['duracion'], 'safe'],
            [['fechaprog', 'finicio', 'ftermino'], 'string', 'max' => 19],
            [['codtra'], 'string', 'max' => 6],
            [['fingreso', 'codaula', 'fregistro'], 'string', 'max' => 10],
            [['calificacion'], 'string', 'max' => 1],
            [['talleresdet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Talleresdet::className(), 'targetAttribute' => ['talleresdet_id' => 'id']],
            [['talleres_id'], 'exist', 'skipOnError' => true, 'targetClass' => Talleres::className(), 'targetAttribute' => ['talleres_id' => 'id']],
            [['codtra'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajadores::className(), 'targetAttribute' => ['codtra' => 'codigotra']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'talleresdet_id' => Yii::t('sta.labels', 'Talleresdet ID'),
            'talleres_id' => Yii::t('sta.labels', 'Talleres ID'),
            'fechaprog' => Yii::t('sta.labels', 'Fechaprog'),
            'codtra' => Yii::t('sta.labels', 'Codtra'),
            'finicio' => Yii::t('sta.labels', 'Finicio'),
            'ftermino' => Yii::t('sta.labels', 'Ftermino'),
            'fingreso' => Yii::t('sta.labels', 'Fingreso'),
            'detalles' => Yii::t('sta.labels', 'Detalles'),
            'codaula' => Yii::t('sta.labels', 'Codaula'),
            'nalumnos' => Yii::t('sta.labels', 'Nalumnos'),
            'fregistro' => Yii::t('sta.labels', 'Fregistro'),
            'calificacion' => Yii::t('sta.labels', 'Calificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalleresdet()
    {
        return $this->hasOne(Talleresdet::className(), ['id' => 'talleresdet_id']);
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
    public function getTrabajadores()
    {
        return $this->hasOne(Trabajadores::className(), ['codigotra' => 'codtra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamenes()
    {
        return $this->hasMany(Examenes::className(), ['citas_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CitasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CitasQuery(get_called_class());
    }
    public function beforeSave($insert) {
       
        $this->duracion=$this->resolveDuration();
        return parent::beforeSave($insert);
       
    } 
   
    /*
     * SE ASREGURA DE QUE DURACION SIEMPRE TENGIA UN VALOR RAZOBNABLE Y NO SE A NULO
     */
    private function resolveDuration(){
        if($this->hasBothDates()){
            $this->duracion=$this->toCarbon('ftermino')->
                    diffInMinutes($this->toCarbon('finicio'));
        }else{
            $this->duracion=0;
        }
    }
    
    /*Funcionque verifica que tiene ambas fechas llenas 
     *  finicio  y ftermino      
     *      */
    
    private function hasBothDates(){
        return (!empty($this->finicio) &&  !empty($this->ftermino));
    }
    
    
    
}
