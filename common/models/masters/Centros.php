<?php

namespace common\models\masters;
use common\models\config\Parametros;
use common\models\base\modelBase;
use common\models\masters\CentrosParametros;
use common\models\base\modelBaseTrait;
use Yii;

/**
 * This is the model class for table "{{%centros}}".
 *
 * @property string $codcen
 * @property string $nomcen
 * @property string $codsoc
 * @property string $descricen
 *
 * @property Sociedades $codsoc0
 */
class Centros extends modelBase
{
   //use modelBaseTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%centros}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $reglas= [
            [['codcen', 'nomcen', 'codsoc'], 'required'],
            [['descricen'], 'string'],
            [['codcen'], 'string', 'max' => 4],
            [['nomcen'], 'string', 'max' => 60],
            [['codsoc'], 'string', 'max' => 1],
            [['codcen'], 'unique'],
           [['codsoc'], 'exist', 'skipOnError' => true, 'targetClass' => Sociedades::className(), 'targetAttribute' => ['codsoc' => 'socio']],
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
            'codcen' => Yii::t('models.labels', 'Codcen'),
            'nomcen' => Yii::t('models.labels', 'Nomcen'),
            'codsoc' => Yii::t('models.labels', 'Codsoc'),
            'descricen' => Yii::t('models.labels', 'Descricen'),
        ];
        //return  parent::ruleBlockedFields();
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSociedad()
    {
        return $this->hasOne(Sociedades::className(), ['socio' => 'codsoc']);
    }
    
     public function getParametroscentros()
    {
        return $this->hasMany(\common\models\config\Parametroscentros::className(), ['codcen'=>'codcen']);
    }
    
    /*public function getDocumentos()
    {
        return $this->hasMany(Documentos::className(), ['codocu' => 'codocu']);
    }
    */
    public function afterSave($insert,$changedAttributes){
        if($insert)
        $this->loadParametros();
        return parent::afterSave($insert,$changedAttributes);
    }
    
   private function loadParametros(){
      $params=Parametros::find()->where(['activo' => '1', 'flag' => '1'])->all();
      $centro=$this->codcen;
      //var_dump($centro);die();
      
      foreach($params as $fila){
          $attributes=['codcen'=>$centro,
              'codparam'=>$fila->codparam];
          Centrosparametros::firstOrCreateStatic($attributes);
      }
   }
    
   
}
