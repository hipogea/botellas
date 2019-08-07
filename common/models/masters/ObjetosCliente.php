<?php

namespace common\models\masters;
USE common\models\base\modelBase;
use Yii;

/**
 * This is the model class for table "{{%objcli}}".
 *
 * @property int $id
 * @property string $codpro
 * @property string $descripcion
 * @property string $codigo
 *
 * @property Clipro $codpro0
 */
class ObjetosCliente extends modelBase
{

public $namecliente;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%objcli}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codpro', 'descripcion'], 'required'],
            [['codpro'], 'string', 'max' => 6],
            [['descripcion'], 'string', 'max' => 26],
            [['codigo'], 'string', 'max' => 3],
            [['codpro'], 'exist', 'skipOnError' => true, 'targetClass' => Clipro::className(), 'targetAttribute' => ['codpro' => 'codpro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'codpro' => Yii::t('base.names', 'Codpro'),
            'descripcion' => Yii::t('base.names', 'Descripcion'),
            'codigo' => Yii::t('base.names', 'Codigo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodpro0()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro']);
    }

    /**
     * {@inheritdoc}
     * @return ObjetosClienteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ObjetosClienteQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        
        if($insert)
        $this->codigo=$this->correlativo ('codigo', null, 'codpro');
       return parent::beforeSave($insert);
    }
    
    
    
   
}
