<?php

namespace frontend\modules\bigitems\models;
use frontend\modules\bigitems\interfaces\PlaceInterface;
use Yii;

/**
 * This is the model class for table "{{%lugares}}".
 *
 * @property int $id
 * @property int $direcciones_id
 * @property string $nombre
 * @property string $tienerecepcion
 * @property string $tipo
 *
 * @property Direcciones $direcciones
 */
class Place extends \yii\db\ActiveRecord implements PlaceInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lugares}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['direcciones_id'], 'integer'],
            [['nombre'], 'string', 'max' => 40],
            [['tienerecepcion', 'tipo'], 'string', 'max' => 1],
            [['direcciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direcciones::className(), 'targetAttribute' => ['direcciones_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models.labels', 'ID'),
            'direcciones_id' => Yii::t('models.labels', 'Direcciones ID'),
            'nombre' => Yii::t('models.labels', 'Nombre'),
            'tienerecepcion' => Yii::t('models.labels', 'Tienerecepcion'),
            'tipo' => Yii::t('models.labels', 'Tipo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirecciones()
    {
        return $this->hasOne(Direcciones::className(), ['id' => 'direcciones_id']);
    }
    
    public function purgeAsset($asset){
        
    }
    public function inputAsset($asset){
        
    }
    
    public function move($NewPoint){
        
    }
    /*
     * Retorna una objeto PLaceCustomer,
     * PlaceMovil oe PlacePort segun el tipo de 
     * 
     */
 protected function place(){
        switch ($this->tipo) {
    case 'A':
        return $this;
        break;
    case 'B':  //ES UN EMPLAZAMIENTO MOVIL
        return \frontend\models\PlaceMovil::find($this->id);
        break;
    case 'C'://ES UN EMPLAZAMIENTO  PUERTO 
        \frontend\models\PlacePort::find($this->id);
        break;
    case 'D'://ES UN EMPLAZAMIENTO EMPRESA CLENTE O PROVEEDOR 
        \frontend\models\PlaceCustomer::find($this->id);
        break;
    default:
        return $this;
         }
    }
    
}
