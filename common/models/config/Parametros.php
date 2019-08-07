<?php

namespace common\models\config;
use common\models\config\Parametros;
use common\models\config\Parametrosdocu;
use common\models\masters\Centrosparametros;



use Yii;

/**
 * This is the model class for table "{{%parametros}}".
 *
 * @property string $codparam
 * @property string $desparam
 * @property string $explicacion
 * @property string $tipodato
 * @property int $longitud
 * @property string $activo
 *
 * @property Configuracion[] $configuracions
 */
class Parametros extends \common\models\base\modelBase
{
    
    public $booleanFields=['activo','flag'];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%parametros}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
      $reglas= [
           [['codparam','flag','activo'], 'safe'],
           [['codparam'], 'match','pattern'=>'/[1-9]{1}[0-9]{4}/'],
            [['desparam', 'tipodato', 'activo','longitud'], 'required'],
            [['explicacion'], 'string'],
            [['longitud'], 'integer'],
          //  [['codparam'], 'string', 'max' => 5],
            [['desparam'], 'string', 'max' => 60],
            [['tipodato', 'activo'], 'string', 'max' => 1],
           
        ];
        return   \yii\helpers\ArrayHelper::merge(
              parent::ruleBlockedFields(),
               $reglas );
        
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codparam' => Yii::t('base.names', 'Code'),
            'desparam' => Yii::t('base.names', 'Description'),
            'flag' => Yii::t('base.names', 'Include Centers'),
            'explicacion' => Yii::t('base.names', 'Details'),
            'tipodato' => Yii::t('base.names', 'Date type'),
            'longitud' => Yii::t('base.names', 'Lenght'),
            'activo' => Yii::t('base.names', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfiguracions()
    {
        return $this->hasMany(Configuracion::className(), ['codparam' => 'codparam']);
    }
    
    public function getCentros()
    {
        return $this->hasMany(Centrosparametros::className(), ['codparam' => 'codparam']);
    }
    
    public function getParametrosdocu()
    {
        return $this->hasMany(Parametrosdocu::className(), ['codparam' => 'codparam']);
    }
    
     public function beforeSave($insert){
        if($insert){
           // echo "holis";die();
            $this->codparam=$this->correlativo('codparam');
            
       // } 
        }else{
            if($this->hasChanged('flag') && $this->flag=='1'){
                foreach($this->centros as $fila){
                    $fila->firstOrCreate([
                        
                    ]);
                }
            }
           
    
        }
        
       return parent::beforeSave($insert); 
        
    
    
}


}
