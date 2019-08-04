<?php

namespace frontend\modules\bigitems\models;
use common\models\masters\Documentos;
use common\helpers\h;
use frontend\modules\bigitems\models\LogTransporte;
use frontend\modules\bigitems\Module as BigItemsModule;
use frontend\modules\bigitems\interfaces\Transport;
use frontend\modules\bigitems\traits\assetTrait;
use common\behaviors\FileBehavior;
use Yii;
//use common\traits\baseTrait;
/**
 * This is the model class for table "{{%activos}}".
 
 * @property Logtransporte[] $logtransportes
 */
class Activos extends \common\models\base\modelBase implements Transport
{
  use assetTrait;
  const SCENARIO_MOVE='move';
  const SCENARIO_MARKED_FOR_TRANSPORT='flagTransport';
  public $booleanFields=['espadre','entransporte'];
   public $dateorTimeFields=['fecha'=>self::_FDATE];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activos}}';
    }

    
    public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		],
               
		
	];
}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['codigo'/*, 'codigo2'*/], 'required'],
            [['codigo'], 'match','pattern'=> self::maskCodePpal(),'message'=>'El valor debe ser '.self::maskCodePpal()],
            [['codigo2'], 'match','pattern'=> self::maskCodeSec(),'message'=>'El valor debe ser '.self::maskCodeSec()],
            [['codigo'], 'unique'],
            [['codigo2'], 'unique'],
            
            [['lugar_original_id', 'lugar_id'], 'integer'],
           // [['codigo', 'codigo2', 'codigo3'], 'string', 'max' => 16],
            [['descripcion', 'serie'], 'string', 'max' => 40],
            [['descripcion'], 'required'],
            [['marca', 'modelo'], 'string', 'max' => 30],
            [['anofabricacion'], 'match', 'pattern' => '/[1-2]{1}[0-9]{3}/'],
            [['codigoitem'], 'string', 'max' => 14],
            [['codigocontable', 'numdoc'], 'string', 'max' => 20],
            [['tipo', 'codestado'], 'string', 'max' => 2],
            [['codarea'], 'string', 'max' => 3],
            [['fecha'], 'string', 'max' => 10],
            //[['codocu'], 'string', 'max' => 3],
            
            /*scenario Move
             *  */
             [['fecha','codocu','numdoc'], 'required', 'on' =>[self::SCENARIO_MOVE]],
            [['fecha','codocu','numdoc',
              'entransporte','lugar_id',
                'direccion_id','direccion_original_id,lugar_original_id'
              ], 'safe', 'on' =>[self::SCENARIO_MOVE]
             ],
            /**/
            
            /*scenario flag tranposrt
             *  */
             [['entransporte'], 'safe', 'on' =>[self::SCENARIO_MARKED_FOR_TRANSPORT]],
            
            /**/
            
            [['codocu'], 'string', 'max' => 3],
            
            
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
            //'id' => 'ID',
            'codigo' => yii::t('bigitems.labels','Code'),
            'codigo2' => yii::t('bigitems.labels','Universal Code'),            
            'descripcion' => yii::t('bigitems.labels','Description'),
            'marca' => yii::t('bigitems.labels','Manufacturer'),
            'modelo' => yii::t('bigitems.labels','Model'),
            'serie' =>  yii::t('bigitems.labels','Serial'),
            'anofabricacion' => yii::t('bigitems.labels','Year'),
            'codigoitem' => yii::t('bigitems.labels','Item Code'),
           // 'codigocontable' => 'Codigocontable',
            'espadre' => yii::t('bigitems.labels','Has Childs'),
            'lugar_original_id' => yii::t('bigitems.labels','Original Place'),
            'tipo' => yii::t('bigitems.labels','Type'),
            'codarea' => yii::t('bigitems.labels','Departament'),
            'codestado' => yii::t('bigitems.labels','Status'),
            'lugar_id' => yii::t('bigitems.labels','Place'),
            'fecha' => yii::t('bigitems.labels','Date'),
            'codocu' => yii::t('bigitems.labels','Document'),
            'numdoc' => yii::t('bigitems.labels','Doc Number'),
            'entransporte' => yii::t('bigitems.labels','In Transport'),
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
    public function getDocumento()
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
      return (BigItemsModule::withPlaces())?'lugar_id':'direccion_id'; 
   }
   private static function campoRefAnt(){
      return (BigItemsModule::withPlaces())?'lugar_original_id':'direccion_original_id';
   } 
   
   
    /*
     * Fecha : En formato Y-m-d
     */
    public function   moveAsset($codocu,$numdoc,$fecha,$nuevolugar){ 
     if($this->canMove()){
         $modelLogTransporte=New LogTransporte();
      //Asignado los valores de Activos a Log
       $modelLogTransporte=$this->transferData($modelLogTransporte);
       //Asignado los parametros a los campos de Activos
       $this->prepareData($codocu,$numdoc,$fecha,$nuevolugar);     
       //Iniciando la transaccion y grabando
       
       //colocando el escenario
       $this->setScenario(self::SCENARIO_MOVE);
        $transa=$this->getDb()->beginTransaction();
         if($this->save() && $modelLogTransporte->save()){
             $transa->commit();
             return true;        
         }else{
             $transa->rollBack();
             print_r($this->attributes);
             print_r($this->getErrors());print_r($modelLogTransporte->getErrors());die();             
            return false;         }     
     } else {
         return false;
     }
         
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
                    if($this->save() && $modelLogTransporte->delete()>0){
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
        $campos[$camporefactual]=$this->{$camporefactual};
         $campos[$camporefanterior]=$this->{$camporefanterior};
      // print_r($campos);die();
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
         $campos[$camporefanterior]=$modelLogTransporte->{$camporefanterior};
       $this->setAttributes($campos); 
       return $this;
    }
    
    /*Prepara los campos log para transportar  */
    private function prepareData($codocu,$numdoc,$fecha,$nuevolugar){
         $campos=[
            'codocu'=>$codocu,
            'numdoc'=>$numdoc,
            'fecha'=>$fecha,
        ];
         $camporefactual=static::campoRefActual();
      $camporefanterior=static::campoRefAnt();
      //agregamos los campos que faltan
        $campos[ $camporefactual]=$nuevolugar;
         $campos[$camporefanterior]=$this->{$camporefactual}; //refrescar el campo  'anterior' este campo
         $this->setScenario(static::SCENARIO_MOVE);
       
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
    
    public function changeOnTransport($save=true){
        if($this->canMove()){
            $this->entransporte=true;
                if($save){
                    $this->setScenario($this::SCENARIO_MARKED_FOR_TRANSPORT);
                    return $this->save();
                    }else{
                     return true;
            
                    }
        }else{
            return false;
        }
        
        
        
    }
     public function changeOffTransport($save=true){
       if($this->canMove()){
            $this->entransporte=false;
                if($save){
                    $this->setScenario($this::SCENARIO_MARKED_FOR_TRANSPORT);
                    return $this->save();
                    }else{
                     return true;
            
                    }
        }else{
            return false;
        }
        
        
        
    }
   public function   canMoveAsset(){
       return true;
   }
   
     public function   canRevertMoveAsset(){
         return true;
     }
    
    
    
    public static function maskCodePpal(){
        return h::settings()->get(BigItemsModule::getId(), BigItemsModule::MASCARA_CODIGO_PPAL);
    }
    public static function maskCodeSec(){
       return h::settings()->get(BigItemsModule::getId(), BigItemsModule::MASCARA_CODIGO_SEC);
    }
}
