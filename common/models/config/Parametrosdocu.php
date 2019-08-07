<?php

namespace common\models\config;
use common\models\config\Parametroscentrosdocu;
use common\models\masters\Centros;
use Yii;

/**
 * This is the model class for table "{{%parametrosdocu}}".
 *
 * @property int $id
 * @property string $codparam
 * @property string $codocu
 *
 * @property Parametros $codparam0
 * @property Documentos $codocu0
 */
class Parametrosdocu extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%parametrosdocu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codparam', 'codocu'], 'required'],
            [['codparam', 'codocu'], 'string', 'max' => 5],
            [['codparam'], 'exist', 'skipOnError' => true, 'targetClass' => Parametros::className(), 'targetAttribute' => ['codparam' => 'codparam']],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
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
            'codocu' => Yii::t('app', 'Codocu'),
        ];
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
        return $this->hasOne(\common\models\masters\Documentos::className(), ['codocu' => 'codocu']);
    }
    
     public function getParamdocus()
    {
        return $this->hasMany(Parametroscentrosdocu::className(), ['codocu' => 'codocu','codparam'=>'codparam']);
    }

    /**
     * {@inheritdoc}
     * @return ParametrosdocuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ParametrosdocuQuery(get_called_class());
    }
    
     public function afterSave($insert, $changedAttributes) {
        if($insert){
            
            $this->fillDocusParams();
            
        }
      return  parent::afterSave($insert, $changedAttributes);
    }
    
    /*Esta funcin actuyaliza aguas abajo l
     * la tabla de valores parametros documentos
     */
    public function fillDocusParams(){
        $centros=Centros::find()->all();
        foreach($centros as $centro){
           $modelo=New Parametroscentrosdocu();
           $modelo->setAttributes(
                   [
                       'codcen'=>$centro->codcen,
               'codparam'=>$this->codparam,
                       'codocu'=>$this->codocu,
                       ]);
          IF(!($modelo->save())){
              PRINT_R($modelo->getErrors());DIE(); 
          }
             
           
           
        }
    }
}
