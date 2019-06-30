<?php

namespace common\models\masters;
use common\models\base\modelBase;
use Yii;

/**
 * This is the model class for table "{{%trabajadores}}".
 *
 * @property string $codigotra
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property string $dni
 * @property string $ppt
 * @property string $pasaporte
 * @property string $codpuesto
 * @property string $cumple
 * @property string $fecingreso
 * @property string $domicilio
 * @property string $telfijo
 * @property string $telmoviles
 * @property string $referencia
 */
class Trabajadores extends modelBase
{
   
   
    
     
    public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => \nemmo\attachments\behaviors\FileBehavior::className()
		]
		
	];
}
    
    
     public function init(){
         $this->prefijo='76';
         $this->dateorTimeFields=['fecingreso'=>self::_FDATE,'cumple'=>self::_FDATE];
            return parent::init();
     }
     
     
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%trabajadores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ap', 'am', 'nombres', 'codpuesto', 'fecingreso','cumple'], 'required'],
            [['cumple', 'fecingreso'], 'validateFechas'],
            [['codigotra'], 'string', 'max' => 6],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['dni', 'ppt', 'pasaporte', 'cumple', 'fecingreso'], 'string', 'max' => 10],
            [['codpuesto'], 'string', 'max' => 3],
            [['domicilio'], 'string', 'max' => 73],
            [['telfijo'], 'string', 'max' => 13],
            [['telmoviles', 'referencia'], 'string', 'max' => 30],
            [['codigotra'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigotra' => Yii::t('models.labels', 'Codigotra'),
            'ap' => Yii::t('models.labels', 'Ap'),
            'am' => Yii::t('models.labels', 'Am'),
            'nombres' => Yii::t('models.labels', 'Nombres'),
            'dni' => Yii::t('models.labels', 'Dni'),
            'ppt' => Yii::t('models.labels', 'Ppt'),
            'pasaporte' => Yii::t('models.labels', 'Pasaporte'),
            'codpuesto' => Yii::t('models.labels', 'Codpuesto'),
            'cumple' => Yii::t('models.labels', 'Cumple'),
            'fecingreso' => Yii::t('models.labels', 'Fecingreso'),
            'domicilio' => Yii::t('models.labels', 'Domicilio'),
            'telfijo' => Yii::t('models.labels', 'Telfijo'),
            'telmoviles' => Yii::t('models.labels', 'Telmoviles'),
            'referencia' => Yii::t('models.labels', 'Referencia'),
        ];
    }

    
    public function validateFechas($attribute, $params)
    {
       $this->toCarbon('fecingreso');
       $this->toCarbon('cumple');
       self::CarbonNow();
       if($this->toCarbon('fecingreso')->greaterThan(self::CarbonNow())){
            $this->addError('fecingreso', yii::t('base.errors','The field {campo} is greater than current day',
                    ['campo'=>$this->getAttributeLabel('fecingreso')]));
       }
       if(self::CarbonNow()->diffInYears( $this->toCarbon('cumple')) < 18){
            $this->addError('cumple', yii::t('base.errors','This person is very Young to be worker',
                    ['campo'=>$this->getAttributeLabel('cumple')]));
       }
        /*if (!in_array($this->$attribute, ['USA', 'Indonesia'])) {*/
           
        /*}*/
    }
 
    
    public function beforeSave($insert) {
        if($insert)
        $this->codigotra=$this->correlativo('codigotra');
        
       return parent::beforeSave($insert);
    }
    

}