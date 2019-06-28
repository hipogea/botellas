<?php

namespace frontend\modules\bigitems\models;
use frontend\modules\bigitems\models\LogTransporte;
use frontend\modules\bigitems\interfaces\Transport;
use frontend\modules\bigitems\traits\assetTrait;
use Yii;
//use common\traits\baseTrait;
/**
 * This is the model class for table "{{%activos}}".
 *
 * @property int $id
 * @property string $codigo
 * @property string $codigo2
 * @property string $codigo3
 * @property string $descripcion
 * @property string $marca
 * @property string $modelo
 * @property string $serie
 * @property string $anofabricacion
 * @property string $codigoitem
 * @property string $codigocontable
 * @property string $espadre
 * @property int $lugar_original_id
 * @property string $tipo
 * @property string $codarea
 * @property string $codestado
 * @property int $lugar_id
 * @property string $fecha
 * @property string $codocu
 * @property string $numdoc
 * @property string $entransporte
 *
 * @property Lugares $lugar
 * @property Lugares $lugarOriginal
 * @property Documentos $codocu0
 * @property Logtransporte[] $logtransportes
 */
class Activos extends \common\models\base\modelBase implements Transport
{
  use assetTrait;
  const SCENARIO_MOVE='move';
  public $booleanFields=['espadre','entransporte'];
   public $dateorTimeFields=['fecha'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lugar_original_id', 'lugar_id'], 'integer'],
            [['codigo', 'codigo2', 'codigo3'], 'string', 'max' => 16],
            [['descripcion', 'serie'], 'string', 'max' => 40],
            [['marca', 'modelo'], 'string', 'max' => 30],
            [['anofabricacion'], 'string', 'max' => 4],
            [['codigoitem'], 'string', 'max' => 14],
            [['codigocontable', 'espadre', 'numdoc'], 'string', 'max' => 20],
            [['tipo', 'codestado'], 'string', 'max' => 2],
            [['codarea', 'entransporte'], 'string', 'max' => 3],
            [['fecha'], 'string', 'max' => 10],
            [['codocu'], 'string', 'max' => 1],
            [['codigo'], 'unique'],
            [['codigo2'], 'unique'],
            [['codigo3'], 'unique'],
            [['lugar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lugares::className(), 'targetAttribute' => ['lugar_id' => 'id']],
            [['lugar_original_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lugares::className(), 'targetAttribute' => ['lugar_original_id' => 'id']],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'codigo2' => 'Codigo2',
            'codigo3' => 'Codigo3',
            'descripcion' => 'Descripcion',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'serie' => 'Serie',
            'anofabricacion' => 'Anofabricacion',
            'codigoitem' => 'Codigoitem',
            'codigocontable' => 'Codigocontable',
            'espadre' => 'Espadre',
            'lugar_original_id' => 'Lugar Original ID',
            'tipo' => 'Tipo',
            'codarea' => 'Codarea',
            'codestado' => 'Codestado',
            'lugar_id' => 'Lugar ID',
            'fecha' => 'Fecha',
            'codocu' => 'Codocu',
            'numdoc' => 'Numdoc',
            'entransporte' => 'Entransporte',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugar()
    {
        return $this->hasOne(Lugares::className(), ['id' => 'lugar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugarOriginal()
    {
        return $this->hasOne(Lugares::className(), ['id' => 'lugar_original_id']);
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
    public function getLogtransportes()
    {
        return $this->hasMany(Logtransporte::className(), ['activo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ActivosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActivosQuery(get_called_class());
    }
    
   private static function campoRefActual(){
      return ($this->withPlaces())?'direccion_id':'lugar_id'; 
   }
   private static function campoRefAnt(){
      return ($this->withPlaces())?'direccion_anterior_id':'lugar_anterior_id';
   } 
   
   
    /*
     * Fecha : En formato Y-m-d
     */
    public function   moveAsset($codocu,$numdoc,$fecha,$nuevolugar){ 
      $modelLogTransporte=New LogTransporte();
      //Asignado los valores de Activos a Log
       $modelLogTransporte=$this->transferData($modelLogTransporte);
       //Asignado los parametros a los campos de Activos
       $this->prepareData($codocu,$numdoc,$fecha,$nuevolugar);     
       //Iniciando la transaccion y grabando
        $transa=$this->getDb()->beginTransaction();
         if($this->save() && $modelTransporte->save()){
             $transa->commit();
             return true;        
         }else{
             $transa->rollBack();
             print_r($this->getErrors());print_r($modelTransporte->getErrors());die();             
            return false;         }        
    }
    
    
    
    
    private function logTransport(){
        
    }
    
   
  /*sOLO DEBE BUSCAR EL UTIMO MOVIMIENTO*/
     public function   revertMoveAsset(){
         $modelLogTransporte=$this->lastMovement();
         if(!is_null($modelLogTransporte) ){ //si es que ya se ha movido alguan vez
             if($this->canRevert()){//Si es posible revertir
                 //recoger los valores del Log
                $this->recipeData($modelLogTransporte);
                $transa=$this->getDb()->beginTransaction();
                    if($this->save() && $modelTransporte->delete()>0){
                         $transa->commit();
                        return true;        
                        }else{
                            $transa->rollBack();
                            print_r($this->getErrors());print_r($modelTransporte->getErrors());die();             
                        return false;         }   
                }else{
                 
             }
             
         }ELSE{
             return true;
         }
     }
     
     
     /*Donde se ecnuentra*/
    public function whereIam(){
        
    }
   
    
    public function lastMovement(){
        return LogTransporte::lastMovement($this->id);
    }
    
    /*Transfiere datos de Activos al modelo LogTransporte */
    private function transferData(&$modelLogTransporte){
         $camporefactual=static::campoRefActual();
         $camporefanterior=static::campoRefAnt();         
          $campos=[
            'activo_id'=>$this->id,
            'numdoc'=>$this->numdoc,
               'codocu'=>$this->codocu,  
            'fecha'=>$this->fecha,
              'codestado'=>$this->codestado            
                    ];      
        $campos[$camporefactual]=$this->getOldAttribute($this->{$camporefactual});
         $campos[$camporefanterior]=$this->getOldAttribute($this->{$camporefant});
       $modelLogTransporte->setAttributes($campos); 
       return $modelLogTransporte;
    }
    
    
    /*Transfiere datos de  LogTransporte al modelo Activos */
    private function recipeData($modelLogTransporte){
         $camporefactual=static::campoRefActual();
         $camporefanterior=static::campoRefAnt();         
          $campos=[
            'activo_id'=>$modelLogTransporte,
            'numdoc'=>$modelLogTransporte->numdoc,
               'codocu'=>$modelLogTransporte->codocu,  
            'fecha'=>$modelLogTransporte->fecha,
              'codestado'=>$modelLogTransporte->codestado            
                    ];      
        $campos[$camporefactual]=$modelLogTransporte->{$camporefactual};
         $campos[$camporefanterior]=$modelLogTransporte->{$camporefant};
       $this->setAttributes($campos); 
       return $this;
    }
    
    /*Prepara los campos log para transportar  */
    private function prepareData($codocu,$numdoc,$fecha,$nuevolugar){
         $camporefactual=static::campoRefActual();
      $camporefanterior=static::campoRefAnt();
        $campos[ $camporefactual]=$nuevolugar;
         $campos[$camporefanterior]=$this->{$camporefactual}; //actualizar este campo
         $this->setScenario(static::SCENARIO_MOVE);
        $campos=[
            'codocu'=>$codocu,
            'numdoc'=>$numdoc,
            'fecha'=>$fecha,
        ];
        $this->setAttributes($campos);
    }
    /*Esta funcion analiza si s epuede realizar el movimietn reversa*/
    public function canRevert(){
      return true;
    }
    
    /*Esta funcion analiza si s epuede realizar el movimietn */
    public function canMove(){
      return true;
    }
    
    public function changeOnTransport(){
        $this->entransporte=true;
    }
     public function changeOffTransport(){
        $this->entransporte=false;
    }
}
