<?php

namespace common\models\masters;
use common\helpers\h;
use Yii;

/**
 * This is the model class for table "{{%clipro}}".
 *
 * @property string $codpro
 * @property string $despro
 * @property string $rucpro
 * @property string $telpro
 * @property string $web
 * @property string $deslarga
 */
class Clipro extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public $prefijo='37';
    public $withAudit=true;
    public $fecha;
    //public $booleanFields=[''];
    public static function tableName()
    {
        return '{{%clipro}}';
    }
    
    
    
    
    public function behaviors()
         {
                return [
		
		/*'fileBehavior' => [
			'class' => '\frontend\modules\attachments\behaviors\FileBehaviorAdvanced' 
                               ],*/
                    'auditoriaBehavior' => [
			'class' => '\common\components\AuditBehavior' ,
                               ],
		
                    ];
        }
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
       
        return [
            [['despro', 'rucpro'], 'required'],
            [['deslarga'], 'string'],
            //[['codpro'], 'string', 'max' => 6],
            [['despro'], 'string', 'max' => 60],
            [['rucpro', 'telpro'], 'string', 'max' => 15],
            [['web'], 'string', 'max' => 85],
             ['rucpro', 'unique'],
             ['rucpro','match',
                 'pattern'=>h::settings()->get('general','formatoRUC'),
                 'message'=>yii::t('base.errors','The {field} doesn\'t match with format',['field'=>$this->getAttributeLabel('rucpro')])
                
                 ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codpro' => Yii::t('base.names', 'Code'),
            'despro' => Yii::t('base.names', 'Description'),
            'rucpro' => Yii::t('base.names', 'Record Contr'),
            'telpro' => Yii::t('base.names', 'Phone Number'),
            'web' => Yii::t('base.names', 'web'),
            'deslarga' => Yii::t('base.names', 'Long Text'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CliproQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CliproQuery(get_called_class());
    }
    
    
    public function beforeSave($insert) {
        //var_dump($insert);die();
        if($insert){
            $this->codpro=$this->correlativo('codpro');
        }
        return parent::beforeSave($insert);
    }
    
}
