<?php

namespace common\models\masters;
use common\models\masters\Centros;
use common\models\config\Parametroscentros;
use Yii;

/**
 * This is the model class for table "{{%centrosparametros}}".
 *
 * @property int $id
 * @property string $codparam
 * @property string $codcen
 * @property string $valor
 * @property string $valor1
 * @property string $valor2
 *
 * @property Centros $codcen0
 * @property Parametros $codparam0
 */
class Centrosparametros extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%centrosparametros}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codparam', 'codcen'], 'string', 'max' => 5],
              [['codparam', 'codcen'], 'required'],
            [['valor'], 'string', 'max' => 60],
            [['valor1', 'valor2'], 'string', 'max' => 3],
            [['codcen'], 'exist', 'skipOnError' => false, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
            [['codparam'], 'exist', 'skipOnError' => false, 'targetClass' => \common\models\config\Parametros::className(), 'targetAttribute' => ['codparam' => 'codparam']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codparam' => Yii::t('app', 'Codparam'),
            'codcen' => Yii::t('app', 'Codcen'),
            'valor' => Yii::t('app', 'Valor'),
            'valor1' => Yii::t('app', 'Valor1'),
            'valor2' => Yii::t('app', 'Valor2'),
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
    public function getParameters()
    {
        return $this->hasOne(\common\models\config\Parametros::className(), ['codparam' => 'codparam']);
    }
    
    public function getCentrosparametros()
    {
        return $this->hasMany(\common\models\config\Parametroscentros::className(), ['codparam' => 'codparam','codcen'=>'codcen']);
    }

    /**
     * {@inheritdoc}
     * @return CentrosparametrosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CentrosparametrosQuery(get_called_class());
    }
    
    public function afterSave($insert, $changedAttributes) {
        if($insert){
            $this->fillCenters();
            
        }
        parent::afterSave($insert, $changedAttributes);
    }
    
    /*Esta funcin actuyaliza aguas abajo l
     * la tabla de valores parametros centros
     */
    public function fillCenters(){
        $centros=Centros::find()->all();
        foreach($centros as $centro){
           $modelo=New Parametroscentros();
           $modelo->setAttributes(['codcen'=>$centro->codcen,'codparam'=>$this->codparam]);
           if(!$modelo->save()){
              // print_r($modelo->getErrors());die();
           }
           unset($modelo);
        }
    }
}
