<?php

namespace common\models\masters;
use common\helpers\h;
use Yii;

/**
 * This is the model class for table "{{%valoresdefault}}".
 *
 * @property int $id
 * @property string $codocu
 * @property int $user_id
 * @property string $nombrecampo
 * @property string $valor
 */
class Valoresdefault extends \common\models\base\modelBase
{
    const ESCENARIO_CREACION='creacion';
    public $booleanFields=['activo'];
    public $_tabla;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%valoresdefault}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codocu', 'nombrecampo'], 'required','on'=>self::ESCENARIO_CREACION],
           [['codocu','nombrecampo'],
                'unique',
                'targetAttribute' =>['codocu', 'nombrecampo','user_id'],
                'message'=>'Esta combinacion de valores ya esta registrada '. $this->codocu.'-'.$this->nombrecampo.'-'.$this->user_id  ,
                'on'=>self::ESCENARIO_CREACION
            ],
            [['user_id'], 'integer'],
            [['valor'], 'string'],
            [['codocu'], 'string', 'max' => 3],
            [['nombrecampo'], 'string', 'max' => 50],
        ];
    }

    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::ESCENARIO_CREACION] = ['activo','aliascampo','codocu','nombrecampo','user_id','valor'];
       // $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }
    
    public function beforeSave($insert){
        
        return parent::beforeSave($insert);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'codocu' => Yii::t('base.names', 'Codocu'),
            'user_id' => Yii::t('base.names', 'User ID'),
            'nombrecampo' => Yii::t('base.names', 'Nombrecampo'),
            'valor' => Yii::t('base.names', 'Valor'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ValoresdefaultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ValoresdefaultQuery(get_called_class());
    }
    
    public function getDocumento()
    {       
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
     
       }
       
    public function afterfind(){
        $cadena=$this->documento->tabla;
        if(!is_string($cadena))
           throw new \yii\base\Exception(Yii::t('base.errors', 'Property "Table" from Documents is empty'));
        $this->_tabla=$cadena;
        $this->isModelBase();
        
        return parent::afterfind();
    }
    
    private function isModelBase(){
        $table=new $this->_tabla;    
         if(!$table instanceof \common\models\base\modelBase ){
             //var_dump(get_class($table));die();
           throw new \yii\base\Exception(Yii::t('base.errors', 'The model {modelo} is not instance from modelBase',['modelo'=>$this->_tabla]));
         
         }
    }
    /*Veriica si el campo a tratar es una cmpo clave para el modelo "table"*/
    public function isFieldLinkForTable(){
        $table=new $this->_tabla;     
        return in_array($this->nombrecampo,array_keys($table->fieldsLink(false)));
        
    }
    
    /*Funcion que obetiene los campos y sus valores 
     * para asignlos directamente al modelo 
     * beneficiado 
     * ['nombrecampo'=>'valor',   ...]
     */
    public static function atributesForDefault($codocu){
       // var_dump($codocu);die();
       return \yii\helpers\ArrayHelper::map(
     static::find()->where(['[[user_id]]'=>h::userId(),
         '[[codocu]]'=>$codocu])->all(),
                'nombrecampo','valor');
          }
    
}
