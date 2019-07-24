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
    
    public function getDocumentos()
    {       
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
     
       }
    
    
}
