<?php

namespace frontend\modules\sta\models;
use common\behaviors\FileBehavior;
use Yii;

/**
 * This is the model class for table "{{%sta_entregas}}".
 *
 * @property int $id
 * @property string $codfac
 * @property string $fecha
 * @property string $fechacorte
 * @property string $version
 * @property string $codperiodo
 * @property string $codalu
 *
 * @property StaFacultades $codfac0
 */
class Entregas extends \common\models\base\DocumentBase
{
    /**
     * {@inheritdoc}
     */
    
    //public $modelo='\\frontend\modules\sta\models\Aluriesgo';
    public $dateorTimeFields=[
       'fecha'=> self::_FDATE,
         'fechacorte'=> self::_FDATE,
       ];
    public $booleanFields=['tienecabecera'];
    public static function tableName()
    {
        return '{{%sta_entregas}}';
    }

    
     public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		]
		
	];
}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha','descripcion','codperiodo','fechacorte','modelo','escenario'], 'required'],
            [['descripcion'], 'string', 'max' => 40],
            ['codperiodo', 'unique', 'targetAttribute' => ['modelo', 'codperiodo']],
            [['fecha', 'fechacorte'], 'string', 'max' => 10],
             [['fecha', 'fechacorte'], 'validateFechas'],
            [['version'], 'string', 'max' => 1],
            [['codperiodo'], 'string', 'max' => 6],
            [['detalles','tienecabecera'], 'safe', 'on' => 'default'],
          
            //[['codfac'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['codfac' => 'codfac']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'codfac' => Yii::t('sta.labels', 'Facultad'),
            'fecha' => Yii::t('sta.labels', 'Fecha'),
            'fechacorte' => Yii::t('sta.labels', 'F Corte'),
            'version' => Yii::t('sta.labels', 'Version'),
            'codperiodo' => Yii::t('sta.labels', 'Periodo'),
            'modelo' => Yii::t('sta.labels', 'Tabla'),
            'escenario' => Yii::t('sta.labels', 'Acción'),
            'tienecabecera' => Yii::t('import.labels', 'File carga con cabecera'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodfac0()
    {
        return $this->hasOne(Facultades::className(), ['codfac' => 'codfac']);
    }

    /**
     * {@inheritdoc}
     * @return EntregasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EntregasQuery(get_called_class());
    }
    
    
     public function validateFechas($attribute, $params)
    {
      // $this->toCarbon('fecingreso');
       //$this->toCarbon('cumple');
       //self::CarbonNow();
       //var_dump(self::CarbonNow());
        
       if($this->toCarbon('fechacorte')->greaterThan($this->toCarbon('fecha'))){
            $this->addError('fechacorte', yii::t('base.errors','El valor del campo {campo1} es posterior al campo {campo2}',
                    ['campo1'=>$this->getAttributeLabel('fechacorte'),
                        'campo2'=>$this->getAttributeLabel('fecha')]));
       }
      // if(self::CarbonNow()->diffInYears( $this->toCarbon('cumple')) < 18){
       /*if($this->age() < 18){
            $this->addError('cumple', yii::t('base.errors','This person is very Young to be worker',
                    ['campo'=>$this->getAttributeLabel('cumple')]));
       }
        /*if (!in_array($this->$attribute, ['USA', 'Indonesia'])) {*/
           
        /*}*/
    }
    
    public function beforeSave($insert) {
       
        if($insert){
            //$this->prefijo=$this->codfac;
           $this->resolveCodocu();
            $this->numero=$this->correlativo('numero');
        }
        
        return parent::beforeSave($insert);
       
    }
}
