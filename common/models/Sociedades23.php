<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%sociedades}}".
 *
 * @property string $socio
 * @property string $dsocio
 * @property string $rucsoc
 * @property string $activo
 * @property string $direccionfiscal
 * @property string $telefonos
 * @property string $web
 * @property string $mail
 * @property string $regimentributario
 *
 * @property Centros[] $centros
 */
use common\models\base\modelBase;
class Sociedades extends modelBase
{
    /**
     * {@inheritdoc}
     */
    public function init(){
        $this->withAudit=true;
        return parent::init();
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
    
    
    public static function tableName()
    {
        return '{{%sociedades}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['socio', 'rucsoc'], 'required'],
            [['socio', 'activo'], 'string', 'max' => 1],
            [['dsocio'], 'string', 'max' => 40],
            [['rucsoc'], 'string', 'max' => 18],
            [['direccionfiscal'], 'string', 'max' => 100],
            [['telefonos'], 'string', 'max' => 35],
            [['web'], 'string', 'max' => 150],
            [['mail'], 'string', 'max' => 80],
            [['regimentributario'], 'string', 'max' => 2],
            [['rucsoc'], 'unique'],
            [['socio'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'socio' => Yii::t('models.labels', 'Socio'),
            'dsocio' => Yii::t('models.labels', 'Dsocio'),
            'rucsoc' => Yii::t('models.labels', 'Rucsoc'),
            'activo' => Yii::t('models.labels', 'Activo'),
            'direccionfiscal' => Yii::t('models.labels', 'Direccionfiscal'),
            'telefonos' => Yii::t('models.labels', 'Telefonos'),
            'web' => Yii::t('models.labels', 'Web'),
            'mail' => Yii::t('models.labels', 'Mail'),
            'regimentributario' => Yii::t('models.labels', 'Regimentributario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentros()
    {
        return $this->hasMany(Centros::className(), ['codsoc' => 'socio']);
    }
}
