<?php

namespace frontend\modules\sta\models;
use frontend\modules\sta\models\Aluriesgo;
use frontend\modules\sta\models\UserFacultades;
use frontend\modules\sta\models\Talleresdet;
use frontend\modules\sta\models\Rangos;
use common\models\masters\Trabajadores;
use common\models\masters\Trabajadores AS Psicologo;
use yii\helpers\ArrayHelper;
use Yii;

use common\helpers\h;
USE \yii2mod\settings\models\enumerables\SettingType;

/**
 * This is the model class for table "{{%sta_talleres}}".
 *
 * @property int $id
 * @property string $codfac
 * @property string $codtra
 * @property string $codtra_psico
 * @property string $fopen
 * @property string $fclose
 * @property string $codcur
 * @property string $activa
 * @property string $codperiodo
 * @property string $electivo
 * @property int $ciclo
 *
 * @property StaMaterias $codcur0
 * @property StaFacultades $codfac0
 * @property StaPeriodos $codperiodo0
 */
class Talleres extends \common\models\base\DocumentBase
{
   public $dateorTimeFields=[
       'fopen'=> self::_FDATE,
         'fclose'=> self::_FDATE,
       ];
   //public $hardFields=['codfac','codperiodo'];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_talleres}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ciclo'], 'integer'],
             [['descripcion','codfac','codperiodo','codtra','codtra_psico','fopen'], 'required'],
            [['codfac'], 'string', 'max' => 8],
            [['descripcion'], 'string', 'max' => 40],
            [['tolerancia','duracioncita'], 'safe'],
            // [['descripcion'], 'string', 'max' => 40],
            [['codtra', 'codtra_psico', 'codperiodo'], 'string', 'max' => 6],
            [['fopen', 'fclose', 'codcur'], 'string', 'max' => 10],
            [['activa', 'electivo'], 'string', 'max' => 1],
           // [['codcur'], 'exist', 'skipOnError' => true, 'targetClass' => Materias::className(), 'targetAttribute' => ['codcur' => 'codcur']],
            [['codfac'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['codfac' => 'codfac']],
            [['codperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
         [['detalles'], 'safe','on'=>'default'],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'codfac' => Yii::t('sta.labels', 'Facultad'),
            'numero' => Yii::t('sta.labels', 'Número'),
             'descripcion' => Yii::t('sta.labels', 'Descripción'),
            'codtra' => Yii::t('sta.labels', 'Responsable'),
            'codtra_psico' => Yii::t('sta.labels', 'Tutor Adjunto'),
            'fopen' => Yii::t('sta.labels', 'F Inicio'),
            'fclose' => Yii::t('sta.labels', 'F Cierre'),
            'codcur' => Yii::t('sta.labels', 'Codcur'),
            'activa' => Yii::t('sta.labels', 'Activa'),
            'codperiodo' => Yii::t('sta.labels', 'Periodo'),
            'electivo' => Yii::t('sta.labels', 'Electivo'),
            'ciclo' => Yii::t('sta.labels', 'Ciclo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getCodcur0()
    {
        return $this->hasOne(Materias::className(), ['codcur' => 'codcur']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['codfac' => 'codfac']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(Periodos::className(), ['codperiodo' => 'codperiodo']);
    }
    
    public function getTrabajador()
    {
        return $this->hasOne(Trabajadores::className(), ['codigotra' => 'codtra']);
    }
    
     public function getPsicologo()
    {
        return $this->hasOne(Psicologo::className(), ['codigotra' => 'codtra_psico']);
    }
    
     public function getTutores()
    {
        return $this->hasMany(Tallerpsico::className(), ['talleres_id' => 'id']);
    }
    
    public function getAlumnos()
    {
        return $this->hasMany(Talleresdet::className(), ['talleres_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TalleresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TalleresQuery(get_called_class());
    }
    
    /*
     * Cargalos alumnos de la lista de entregas 
     * em riesgo 
     */
    public function loadStudents(){
        $data=$this->studentsInRiskForThis();
        $cantidad=count($data);
        $contador=0;
       foreach($data as $fila){
          IF(Talleresdet::firstOrCreateStatic([
               'talleres_id'=>$this->id,
               'codalu'=>$fila['codalu'],
           ], Talleresdet::SCENARIO_BATCH ))
          $contador++;        
       }
       return ['total'=>$cantidad,'contador'=>$contador];
    }
    
    pUBLIC function studentsInRiskForThis(){
         $query=Aluriesgo::studentsInRiskQuery();
        $query->andWhere([
               'codfac'=>$this->codfac,
               'codperiodo'=>$this->codperiodo
                   ]);
         /*
        if(count(UserFacultades::filterFacultades())==1){
          $data=$query->asArray()->all();
        }else{
           $data=$query->where([
               'codfac'=>$this->codfac,
               'codperiodo'=>$this->codperiodo
                   ])->asArray()->all();
        }*/
        return $query->asArray()->all();
    }
    
    /*
     * Detecta si hay nuevos estudiantes en riesgo este periodo 
     * Consultando la tabla ALURIESGO
     */
    public function newStudentsInRisk(){
       return Aluriesgo::studentsInRiskQuery()->
                 andWhere([
               'codfac'=>$this->codfac,
               'codperiodo'=>$this->codperiodo
                   ])->
                andWhere(['not in',
              'codalu', ArrayHelper::getColumn($this->studentsInRiskForThis(),'codalu')
               ])->all();
      
    }
    
   public function addPsico($codtra){
       
       
   }
   /*
    * Obtiene la cantidad de alumnos asignados
    * de tutor dentro del programa
    */
   public function busyStudents(){
      return  Talleresdet::find()->where(['talleres_id'=>$this->id])->
          andWhere(['not', ['codtra' => null]])        
          ->all();
       
   }
   
   /*
    * Obtiene la cantidad de alumnos libres
    * de tutor dentro del programa
    */
   public function freeStudents(){
      return  Talleresdet::find()->where(['talleres_id'=>$this->id])->
          andWhere(['codtra' => null])        
          ->all();
       
   }
   
   /*
    * Esta funcion devuelve las cantidades de alunos or turor
    */
   public function countStudentsByTutor($tutor){
      return  Talleresdet::find()->where(['talleres_id'=>$this->id])->
          andWhere(['codtra' => $tutor])        
          ->count();
       
   }
   
   /*
    * Esta funcion devuelve las cantidades de alunos or turor
    */
   public function countStudentsFree(){
      return  Talleresdet::find()->where(['talleres_id'=>$this->id])->
          andWhere(['codtra' => null])        
          ->count();
       
   }
   
   
   
   /*
    * esta funcion sincroniza las cantidades con 
    * las cantidades en la  tabla TALLER_PSICO
    * Especialmente cuando se agregan o se retiran alumns del programa 
    */
   public function sincronizeCant(){
       foreach($this->tutores as $filaTutor){
           $filaTutor->setScenario($filaTutor::SCENARIO_CANTIDAD);
           $filaTutor->nalumnos=$this->countStudentsByTutor($filaTutor->codtra);
          if(!$filaTutor->save())yii::error($filaTutor->getFirstError(),__METHOD__);
       }
   }
   
   public function beforeSave($insert) {
       
        if($insert){
            //$this->prefijo=$this->codfac;
           $this->resolveCodocu();
            $this->numero=$this->correlativo('numero');
        }
        
        return parent::beforeSave($insert);
       
    }
    
    public function afterSave($insert,$changedAttributes) {
       
        if($insert){
            //$this->prefijo=$this->codfac;
           $this->refresh();
          $this->createRangos($this->id); //Llena la tabla rangos por unica vez 
        }
        
        return parent::afterSave($insert,$changedAttributes);
       
    }
    
    
    /*
     * Funcion que crea los rnago u horarios para los 7 días 
     * de la semana
     */
    public function createRangos($id){
        $attributes=[];
        foreach(\common\helpers\timeHelper::daysOfWeek() as $key=>$day){
            $attributes=[
                        'nombredia'=>$day,
                         'talleres_id'=>$id,
                        'dia'=>$key,
                        'hinicio'=> h::getIfNotPutSetting('sta','horainicio','09:00', SettingType::STRING_TYPE),
                        'hfin'=> h::getIfNotPutSetting('sta','horafin','17:00', SettingType::STRING_TYPE),
                        'tolerancia'=> h::getIfNotPutSetting('sta','tolerancia',0.1, SettingType::FLOAT_TYPE),
                         'activo'=>(!in_array($key,[0,6]))?false:true,//SI ES SABADO O DOMINGO POR DEFAULT ES FALSE 
                ];
            yii::error(Rangos::firstOrCreateStatic($attributes));
            yii::error($attributes);
        }
       return true;
    }
    
    
    /*
     * Esta funcion extrae los rangos de 
     * validos para programar las citas dentros de ellos 
     */
    
    
    public function rangesToDates(){
        //Rangos::
    }
}
