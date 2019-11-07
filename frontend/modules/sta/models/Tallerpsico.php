<?php

namespace frontend\modules\sta\models;
use common\models\masters\Trabajadores;
use frontend\modules\sta\models\Talleresdet;
use frontend\modules\sta\models\Citas;
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
    const  SCENARIO_CANTIDAD='cantidad';
    const  SCENARIO_STATUS='estado';
    public $booleanFields=['calificacion'];
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
            [['talleres_id', 'codtra','nalumnos'], 'required'],
            [['talleres_id','nalumnos'], 'integer'],
            [['codtra'], 'string', 'max' => 6],
            [['codtra'], 'unique', 'targetAttribute' => ['codtra', 'talleres_id'],'message'=>yii::t('sta.labels','Este tutor ya está registrado')],
             //[['calificacion'], 'string', 'max' => 1],
             [['nalumnos','calificacion'], 'safe'],
            [['nalumnos'], 'validateCantidades','on'=>'default'],
            [['talleres_id'], 'exist', 'skipOnError' => true, 'targetClass' => Talleres::className(), 'targetAttribute' => ['talleres_id' => 'id']],
        ];
    }

     public function scenarios()
    {
        $scenarios = parent::scenarios(); 
        $scenarios[self::SCENARIO_CANTIDAD] = ['nalumnos'];
        $scenarios[self::SCENARIO_STATUS] = ['calificacion','nalumnos'];
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
            'talleres_id' => Yii::t('sta.labels', 'Talleres ID'),
            'codtra' => Yii::t('sta.labels', 'Tutor'),
            'calificacion' => Yii::t('sta.labels', 'Calificacion'),
            'nalumnos' => Yii::t('sta.labels', 'Cant. Alumnos'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaller()
    {
        return $this->hasOne(Talleres::className(), ['id' => 'talleres_id']);
    }

    public function getCitas()
    {
        return $this->hasMany(Citas::className(), ['talleres_id'=>'id','codtra'=>$this->codtra]);
    }
    
     public function getCitasPendientes()
    {
        return $this->hasMany(Citas::className(), 
                [  'talleres_id'=>'id',
                    'codtra'=>$this->codtra,
                    'duracion'=>0,
                    ]);
    }
    
    public function getCitasRealizadas()
    {
        return $this->hasMany(Citas::className(), 
                [  'talleres_id'=>'id',
                    'codtra'=>$this->codtra,
                    'duracion'>0,
                    ]);
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
    
    /*Asigan estudiantes aleatoriamente segun la cantidad de 
     * de los mismos 
     */
    public function assignStudentsByRandom(){
        $cantidad=$this->nalumnos;
        if($cantidad >0 && !empty($cantidad)){
          $studentsFree=$this->taller->freeStudents();
       $i=1;
       foreach($studentsFree as $student){
           if($i <= $cantidad){
               $student->codtra=$this->codtra;           
                $student->save();
                    $i++;
           }else{
              break;
           }
         }//fin del for 
        }
       
       return true;
     }
     
      public function validateCantidades($attribute, $params)
    {
          $talleres=Talleres::findOne($this->talleres_id);
          $disponible=count($talleres->freeStudents());
          unset($talleres);
          
          if($this->nalumnos > $disponible){
              $this->addError('nalumnos',yii::t('sta.errors','Imposible esta cantidad , ya no hay más alumnos. Sólo quedan ({cantidad}) alumnos ' ,['cantidad'=>$disponible]));
          return;
              
          }
      
    }
     /*DESASOCIA LE TUTOR*/
    public function dettachTutor(){
        /*verifica priero si tiene alumnos
         * Si no los tiene se borra nada mas
         * Si los tuviese, se descativa 
         */
        
        $cantidad=$this->detachStudents();//desacoplar estudiantes
        $this->addMessage(self::MESSAGE_SUCCESS,yii::t('import.messages',' {numero} Alumnos fueron desafiliados con este tutor',['numero'=>$cantidad]));
        
        if($this->hasCitas()){
        $this->addMessage(self::MESSAGE_WARNING,yii::t('import.messages','Este tutor ya tenía citas programadas o efectuadas, sólo es posible desactivarlo '));
      
         $this->disabled();//desactivarlo
         $this->addMessage(self::MESSAGE_SUCCESS,yii::t('import.messages','El tutor ha sido desactivado '));
      
      }else{
          $this->delete();
           $this->addMessage(self::MESSAGE_SUCCESS,yii::t('import.messages','El tutor ha sido desactivado '));
                
      }
      $this->taller->sincronizeCant();
    }
    
    
    /*Verifica si el tutor tiene asignado alumnos
     * 
     */
    public function hasStudents(){
      return ($this->taller->countStudentsByTutor($this->codtra)>0)?true:false; 
    }
    
    /*Desactiva o ambia el estado a desactivado*/
    public function disabled(){
        $old=$this->getScenario();
        $this->setScenario(self::SCENARIO_STATUS);
        $this->calificacion=false;
        $f=$this->save();
        $this->setScenario($old);
        yii::error($this->getFirstError(),__METHOD__);
        return $f;
    }
    
    
    /*Active Query para gestionar las citas
     * 
     */
    
    private function AQueryForCitas(){
        return Citas::find()->where(['talleres_id'=>$this->talleres_id,
           'codtra'=>$this->codtra]);
    }
    
    /*Verifica que ha tenido citas */
    
    public function hasCitas(){
       $ncitas=$this->AQueryForCitas()->count();
        return ($ncitas>0)?true:false;
    }
    /*
     * Esta funcion determina la cantidad de citas 
     * totales
     */
     public function nTotalCitas(){
       $ncitas=$this->AQueryForCitas()->count();
    }
    
    /*
     * Esta funcion determina la cantidad de citas 
     * Hechas
     */
     public function nDoneCitas(){
       $ncitas=$this->AQueryForCitas()->count();
    }
    
    /*
     * Desafilia de los alumnos
     * tabla Tallerdet colocar null 
     * en codtra
     */
    public function detachStudents() {
        return Talleresdet::updateAll(['codtra'=>null], ['codtra'=>$this->codtra]);
    }
    
    public function beforeSave($insert) {
       
        if($insert){
            //$this->prefijo=$this->codfac;
           
            $this->calificacion=true;
        }
        
        return parent::beforeSave($insert);
       
    }
    
    
    /*
     * FUncion que posterga una cita 
     */
    
   public function postergaCita(\Carbon\Carbon $newDate){
       
   }
}
