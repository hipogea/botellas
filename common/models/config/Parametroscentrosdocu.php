<?php

namespace common\models\config;
use common\models\masters\Centros;
use common\models\masters\Documentos;
use common\models\config\Parametros;
use Yii;

/**
 * This is the model class for table "{{%parametrosdocucentros}}".
 *
 * @property int $id
 * @property string $codparam
 * @property string $codcen
 * @property string $codocu
 * @property string $valor
 * @property string $valor2
 *
 * @property Centros $codcen0
 * @property Parametros $codparam0
 * @property Documentos $codocu0
 */
class Parametroscentrosdocu extends \yii\db\ActiveRecord
{
    private $_typedata;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%parametrosdocucentros}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codparam', 'codcen', 'codocu'], 'required'],
            [['valor', 'valor2'], 'string'],
            [['codparam', 'codcen', 'codocu'], 'string', 'max' => 5],
            [['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
            [['codparam'], 'exist', 'skipOnError' => true, 'targetClass' => Parametros::className(), 'targetAttribute' => ['codparam' => 'codparam']],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'codparam' => Yii::t('base.names', 'Codparam'),
            'codcen' => Yii::t('base.names', 'Codcen'),
            'codocu' => Yii::t('base.names', 'Codocu'),
            'valor' => Yii::t('base.names', 'Valor'),
            'valor2' => Yii::t('base.names', 'Valor2'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentros()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametros()
    {
        return $this->hasOne(Parametros::className(), ['codparam' => 'codparam']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
    }

    /**
     * {@inheritdoc}
     * @return ParametroscentrosdocuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ParametroscentrosdocuQuery(get_called_class());
    }
    
    public function afterFind() {
        $this->_typedata=$this->parametros->tipodato;
        parent::afterFind();
    }
    
    public function getValue(){
       // if($this->_typedata=='C')//TEXTO
        if($this->_typedata=='C') //NUMNERICO
         {
             return $this->valor;
         }
            
         if($this->_typedata=='N') //NUMNERICO
         {
             return (is_null($this->valor) or !is_numeric($this->valor))?0:$this->valor+0;
         }
        if($this->_typedata=='B')//BOOLEANO{
             {
            return (is_null($this->valor) or $this->valor=='0' or empty($this->valor))?false:true; 
             }
       
    }
    
}
