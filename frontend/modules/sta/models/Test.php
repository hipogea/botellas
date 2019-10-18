<?php

namespace frontend\modules\sta\models;
use common\behaviors\FileBehavior;
use Yii;

/**
 * This is the model class for table "{{%sta_test}}".
 *
 * @property string $codtest
 * @property string $descripcion
 * @property string $opcional
 * @property string $version
 * @property int $nveces
 */
class Test extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_test}}';
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
            [['codtest', 'descripcion', 'opcional', 'version'], 'required'],
            [['nveces'], 'integer'],
            [['codtest'], 'string', 'max' => 8],
            [['descripcion'], 'string', 'max' => 40],
            [['opcional'], 'string', 'max' => 1],
            [['version'], 'string', 'max' => 5],
            [['codtest'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codtest' => Yii::t('sta.labels', 'Codtest'),
            'descripcion' => Yii::t('sta.labels', 'Descripcion'),
            'opcional' => Yii::t('sta.labels', 'Opcional'),
            'version' => Yii::t('sta.labels', 'Version'),
            'nveces' => Yii::t('sta.labels', 'Nveces'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestQuery(get_called_class());
    }
}
