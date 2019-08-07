<?php

namespace common\models\masters;
use common\behaviors\FileBehavior;
use Yii;
use common\helpers\h;
/**
 * This is the model class for table "{{%maestrocompo}}".
 *
 * @property int $id
 * @property string $codart
 * @property string $descripcion
 * @property string $marca
 * @property string $modelo
 * @property string $numeroparte
 * @property string $codum
 * @property string $peso
 *
 * @property Ums $codum0
 */
class Maestrocompo extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%maestrocompo}}';
    }
 public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		],
               
		
	];
}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion','codtipo','codum'], 'required'],
            [['codart'], 'string', 'max' => 14],
            [['descripcion'], 'string', 'max' => 60],
            [['marca', 'modelo', 'numeroparte'], 'string', 'max' => 30],
            [['codum', 'peso'], 'string', 'max' => 4],
            [['codart'], 'unique'],
            [['codum'], 'exist', 'skipOnError' => true, 'targetClass' => Ums::className(), 'targetAttribute' => ['codum' => 'codum']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'codart' => Yii::t('base.names', 'Codart'),
            'descripcion' => Yii::t('base.names', 'Descripcion'),
            'marca' => Yii::t('base.names', 'Marca'),
            'modelo' => Yii::t('base.names', 'Modelo'),
            'numeroparte' => Yii::t('base.names', 'Numeroparte'),
            'codum' => Yii::t('base.names', 'Codum'),
            'peso' => Yii::t('base.names', 'Peso'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUm()
    {
        return $this->hasOne(Ums::className(), ['codum' => 'codum']);
    }

    /**
     * {@inheritdoc}
     * @return MaestrocompoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaestrocompoQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        //var_dump($insert);die();
        if($insert){
            $this->codart=$this->correlativo('codart',
                h::settings()->get('tables','sizecodigomaterial'),  
                 'codtipo'
                    );
        }
        return parent::beforeSave($insert);
    }
}
