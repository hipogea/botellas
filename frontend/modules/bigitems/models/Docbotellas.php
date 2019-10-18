<?php

namespace frontend\modules\bigitems\models;
use common\models\masters\Direcciones;
//use common\models\masters\Centros;
 use frontend\modules\bigitems\interfaces\Transport;
  use frontend\modules\bigitems\Module as ModuleBigItems;
use common\models\base\DocumentBase;
use common\models\masters\Direcciones as DireccionesB;
use common\models\masters\Trabajadores;
use common\models\masters\Centros;
use common\models\masters\Clipro;

use Yii;

/**
 * This is the model class for table "{{%bigitems_docbotellas}}".
 *
 * @property int $id
 * @property string $codestado
 * @property string $codpro
 * @property string $numero
 * @property string $codcen
 * @property string $descripcion
 * @property string $codenvio
 * @property string $fecdocu
 * @property string $fectran
 * @property string $codtra
 * @property string $codven
 * @property string $codplaca
 * @property int $ptopartida_id
 * @property int $ptollegada_id
 * @property string $comentario
 *
 * @property BigitemsDetdocbotellas[] $bigitemsDetdocbotellas
 * @property Direcciones $ptopartida
 * @property Trabajadores $codtra0
 * @property Clipro $codpro0
 * @property Direcciones $ptollegada
 * @property Trabajadores $codven0
 * @property Centros $codcen0
 */
class Docbotellas extends DocumentBase implements Transport
{
   const SCENARIO_CHANGE_STATUS='escenario_estado';
    public $prefijo='79';
   public $codocu='478';
    public $fieldCodocu='codocu';
    public $fectran1; ///ficitica para poder establecer un rango de echas para busqueda
    public $dateorTimeFields=[
        'fecdocu'=>self::_FDATE,
        'fectran'=>self::_FDATE,
        'fectran1'=>self::_FDATE
        ];
    /**
     * {@inheritdoc}
     */
   
    public function init(){
        $this->fieldStatus='codestado';
        $this->fieldCodCenter='codcen';
       parent::init();
       
    }
    
    
    
    
    public static function tableName()
    {
        return '{{%bigitems_docbotellas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'codpro', 'essalida', 
                //'codcen','codestado',
                'descripcion', 'codenvio', 'fecdocu', 'ptopartida_id', 'ptollegada_id'], 'required'],
            [['ptopartida_id', 'ptollegada_id'], 'validateDirecciones'],
             [['ptopartida_id', 'ptollegada_id'], 'integer'],
            [['comentario'], 'string'],
           
            [['codestado', 'codenvio'], 'string', 'max' => 2],
            [['codpro', 'codtra', 'codven'], 'string', 'max' => 6],
            [['numero', 'fecdocu', 'fectran'], 'string', 'max' => 10],
            [['codcen'], 'string', 'max' => 5],
            [['descripcion'], 'string', 'max' => 40],
            [['codplaca'], 'string', 'max' => 15],
            [['ptopartida_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direcciones::className(), 'targetAttribute' => ['ptopartida_id' => 'id']],
            [['codtra'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajadores::className(), 'targetAttribute' => ['codtra' => 'codigotra']],
            [['codpro'], 'exist', 'skipOnError' => true, 'targetClass' => Clipro::className(), 'targetAttribute' => ['codpro' => 'codpro']],
            [['ptollegada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direcciones::className(), 'targetAttribute' => ['ptollegada_id' => 'id']],
            [['codven'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajadores::className(), 'targetAttribute' => ['codven' => 'codigotra']],
            [['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
        ];
    }

     public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CHANGE_STATUS] = ['codestado'];
         $scenarios['default'][] = 'codocu';
       // $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('bigitems.labels', 'ID'),
            'codestado' => Yii::t('bigitems.labels', 'Codestado'),
            'codpro' => Yii::t('bigitems.labels', 'Codpro'),
            'numero' => Yii::t('bigitems.labels', 'Numero'),
            'codcen' => Yii::t('bigitems.labels', 'Codcen'),
            'descripcion' => Yii::t('bigitems.labels', 'Descripcion'),
            'codenvio' => Yii::t('bigitems.labels', 'Codenvio'),
            'fecdocu' => Yii::t('bigitems.labels', 'Fecdocu'),
            'fectran' => Yii::t('bigitems.labels', 'Fectran'),
            'codtra' => Yii::t('bigitems.labels', 'Codtra'),
            'codven' => Yii::t('bigitems.labels', 'Codven'),
            'codplaca' => Yii::t('bigitems.labels', 'Codplaca'),
            'ptopartida_id' => Yii::t('bigitems.labels', 'Ptopartida ID'),
            'ptollegada_id' => Yii::t('bigitems.labels', 'Ptollegada ID'),
            'comentario' => Yii::t('bigitems.labels', 'Comentario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetdocbotellas()
    {
        return $this->hasMany(Detdocbotellas::className(), ['doc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtopartida()
    {
        return $this->hasOne(DireccionesB::className(), ['id' => 'ptopartida_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportista()
    {
        return $this->hasOne(Trabajadores::className(), ['codigotra' => 'codtra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClipro()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtollegada()
    {
        return $this->hasOne(Direcciones::className(), ['id' => 'ptollegada_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedor()
    {
        return $this->hasOne(Trabajadores::className(), ['codigotra' => 'codven']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentro()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * {@inheritdoc}
     * @return DocbotellasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocbotellasQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        if($insert){
            
            $this->resolveCentros();$this->resolveEstados();
           $this->numero= $this->correlativo('numero');
        }
        return parent::beforeSave($insert);
    }
    
    
   private function resolveEstados(){
        if(empty($this->{$this->fieldStatus})){
           $this->{$this->fieldStatus}='10';
        }
   }
   
   
   
     
     /*
      * Esta funcion resuleve el problema de que 
      * si se devuelve una direccion o un lugar
      * dependeinedo de coo este trabajando el modulo
      */
     public function ptoLlegadaOrAddress(){
      if(ModuleBigItems::withPlaces()){
          return $this->ptollegada->lugares[0]->id;
      }else{
         return $this->ptollegada->id; 
      }
      
     }
     
      /*
      * Esta funcion resuleve el problema de que 
      * si se devuelve una direccion o un lugar
      * dependeinedo de coo este trabajando el modulo
      */
     public function ptoPartidaOrAddress(){
         if(ModuleBigItems::withPlaces()){
          return $this->ptopartida->lugares[0]->id;
      }else{
         return $this->ptopartida->id; 
      }
     }
     
     
     
     
     public function   moveAsset($codocu, $numdoc, $fecha, $nuevolugar){
         foreach($this->detdocbotellas as $fila ){
             $fila->moveAsset();
         }
       }
     public function   revertMoveAsset(){
        
       }
    public function   canMoveAsset(){
        /*
         * El documetno debe de estar 
         */
       }
   
     public function   canRevertMoveAsset(){
        
       }  
      /*Coloca el flag de Transporte en el activo asociado*/ 
    public function setAssetOnTransport(){
       
    }
    
    public function validateDirecciones($attribute, $params)
    {
      if($this->ptollegada_id==$this->ptopartida_id){
          $this->addError('ptollegada_id',yii::t('bigitems.errors','
            Arrival address is the same as the issuing address'));
      }
    }
 
}
