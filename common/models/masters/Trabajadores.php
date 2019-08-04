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
   
   public $nombrecompleto;
    
     
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
             [['dni'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigotra' => Yii::t('base.names', 'Code'),
            'ap' => Yii::t('base.names', 'Last Name'),
            'am' => Yii::t('base.names', "Mother's last name"),
            'nombres' => Yii::t('base.names', 'Names'),
            'dni' => Yii::t('base.names', 'Identity Document'),
            'ppt' => Yii::t('base.names', 'Safe passage'),
            'pasaporte' => Yii::t('base.names', 'Passport'),
            'codpuesto' => Yii::t('base.names', 'Position'),
            'cumple' => Yii::t('base.names', 'Date of Birth'),
            'fecingreso' => Yii::t('base.names', 'Admission date'),
            'domicilio' => Yii::t('base.names', 'Address'),
            'telfijo' => Yii::t('base.names', 'Phone Number'),
            'telmoviles' => Yii::t('base.names', 'Moviles Phone Numbers'),
            'referencia' => Yii::t('base.names', 'References'),
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
    
    public function afterFind(){
        $this->nombrecompleto=$this->ap.'-'.$this->am.'-'.$this->nombres;
        parent::afterFind();
    }

}