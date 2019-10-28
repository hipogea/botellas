<?php

namespace frontend\modules\sta\models;
use frontend\modules\sta\models\Aluriesgo;
use frontend\modules\sta\models\UserFacultades;
use frontend\modules\sta\models\Talleresdet;
use common\models\masters\Trabajadores;
use common\models\masters\Trabajadores AS Psicologo;
use yii\helpers\ArrayHelper;
use Yii;

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
           // [['detalles'], 'string', 'max' => 40],
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
    public function getCodfac0()
    {
        return $this->hasOne(Facultades::className(), ['codfac' => 'codfac']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodperiodo0()
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
   
   public function beforeSave($insert) {
       
        if($insert){
            //$this->prefijo=$this->codfac;
           $this->resolveCodocu();
            $this->numero=$this->correlativo('numero');
        }
        
        return parent::beforeSave($insert);
       
    }
}
