<?php

namespace frontend\modules\bigitems\models;
use frontend\modules\bigitems\models\LogTransporte;
use frontend\modules\bigitems\interfaces\Transport;
use Yii;
use common\traits\baseTrait;
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
  use baseTrait;
  const SCENARIO_MOVE='move';
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
    
   
    public function   moveAsset($codocu,$numdoc,$fecha){
        
        $this->setScenario(static::SCENARIO_MOVE);
        $this->setAttributes([
            'codocu'=>$codocu,
            'numdoc'=>$numdoc,
            'fecha'=>$fecha,
        ]);
        
        $modelTransporte=New LogTransporte();
        $modelTransporte->setAttributes(
                [
            'activo_id'=>$this->id,
            'lugar_id'=>$numdoc,
            'fecha'=>$fecha,
                    ]
                );
        
        
        $this->save();
        
    }
    
    private function logTransport(){
        
    }
    
    private function hasSetting(){
        
    }
  
     public function   revertMoveAsset($asset,$codocu,$numdoc){}
     
     
     /*Donde se ecnuentra*/
    public function whereIam(){
        
    }
    
}
