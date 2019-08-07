<?php

namespace common\models\masters;
use common\models\masters\Clipro;
USE frontend\modules\bigitems\models\Lugares;
use  common\models\masters\Ubigeos;
use common\helpers\h;
use Yii;

/**
 * This is the model class for table "{{%direcciones}}".
 *
 * @property int $id
 * @property string $direc
 * @property string $nomlug
 * @property string $distrito
 * @property string $provincia
 * @property string $departamento
 * @property string $latitud
 * @property string $meridiano
 * @property string $codpro
 *
 * @property Lugares[] $lugares
 */
class Direcciones extends \common\models\base\modelBase
{
    const UPDATE_TYPE_CREATE = 'create';
    const UPDATE_TYPE_UPDATE = 'update';
    const UPDATE_TYPE_DELETE = 'delete';

    const SCENARIO_BATCH_UPDATE = 'batchUpdate';


    private $_updateType;

    public function getUpdateType()
    {
        if (empty($this->_updateType)) {
            if ($this->isNewRecord) {
                $this->_updateType = self::UPDATE_TYPE_CREATE;
            } else {
                $this->_updateType = self::UPDATE_TYPE_UPDATE;
            }
        }

        return $this->_updateType;
    }

    public function setUpdateType($value)
    {
        $this->_updateType = $value;
    }

    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%direcciones}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codpro','direc','coddepa','coddist','codprov'], 'required'],
             [['coddepa','codprov','coddist'], 'safe'],
            [['direc'], 'string', 'max' => 80],
            [['nomlug'], 'string', 'max' => 20],
            [['distrito'], 'string', 'max' => 25],
            [['provincia', 'departamento'], 'string', 'max' => 30],
            [['latitud', 'meridiano'], 'string', 'max' => 15],
            [['codpro'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'direc' => Yii::t('base.names', 'Address'),
            'nomlug' => Yii::t('base.names', 'Place Name'),
            'distrito' => Yii::t('base.names', 'District'),
            'provincia' => Yii::t('base.names', 'Province'),
            'departamento' => Yii::t('base.names', 'Departament'),
            'latitud' => Yii::t('base.names', 'Latitude'),
            'meridiano' => Yii::t('base.names', 'Meridian'),
            'codpro' => Yii::t('base.names', 'Vendor Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugares()
    {
       if(h::app()->hasModule('bigitems'))
        return $this->hasMany(\frontend\modules\bigitems\models\Lugares::className(), ['direcciones_id' => 'id']);
     return false;
       }

    public function getClipro()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro']);
    }

    
    
    /**
     * {@inheritdoc}
     * @return DireccionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DireccionesQuery(get_called_class());
    }
    
    public function afterSave($insert, $changedAttributes) {
        if($insert){
            /*var_dump(h::app()->hasModule('bigitems'));
             var_dump(h::settings()->has('bigitems','withPlaces'));
          var_dump(h::settings()->get('bigitems','withPlaces')=='N');
          var_dump(!is_null(Lugares::find()->one()));die();*/
           if(h::app()->hasModule('bigitems') && 
                 h::settings()->has('bigitems','withPlaces') &&
               h::settings()->get('bigitems','withPlaces')=='N' &&
                    is_null(Lugares::find()->one())
                   ){
                       Lugares::insertFirst();
           }else{
               
           }
        }
       return parent::afterSave($insert, $changedAttributes);
        
    }
    
   
    
    public function getDepartamento(){
        $reg=Ubigeos::find()->where(['coddepa'=>$this->coddepa])->one();
        return (is_null($reg))?'':$reg->departamento;
        
    }
    public function getProvincia(){
        $reg=Ubigeos::find()->where(['codprov'=>$this->codprov])->one();
        return (is_null($reg))?'':$reg->provincia;
        
    }
    public function getDistrito(){
        $reg=Ubigeos::find()->where(['coddist'=>$this->coddist])->one();
        return (is_null($reg))?'':$reg->distrito;
        
    }
}
