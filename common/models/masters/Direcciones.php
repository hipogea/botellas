<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%direcciones}}".
 *
 * @property int $id
 * @property string $direc
 * @property string $nomlug
 * @property string $distrito
 * @property string $provincia
 * @property string $departamento
 * @property string $latitud
 * @property string $meridiano
 * @property string $codpro
 *
 * @property Lugares[] $lugares
 */
class Direcciones extends \common\models\base\modelBase
{
    const UPDATE_TYPE_CREATE = 'create';
    const UPDATE_TYPE_UPDATE = 'update';
    const UPDATE_TYPE_DELETE = 'delete';

    const SCENARIO_BATCH_UPDATE = 'batchUpdate';


    private $_updateType;

    public function getUpdateType()
    {
        if (empty($this->_updateType)) {
            if ($this->isNewRecord) {
                $this->_updateType = self::UPDATE_TYPE_CREATE;
            } else {
                $this->_updateType = self::UPDATE_TYPE_UPDATE;
            }
        }

        return $this->_updateType;
    }

    public function setUpdateType($value)
    {
        $this->_updateType = $value;
    }

    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%direcciones}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codpro','direc','departamento','provincia','distrito',], 'required'],
            [['direc'], 'string', 'max' => 80],
            [['nomlug'], 'string', 'max' => 20],
            [['distrito'], 'string', 'max' => 25],
            [['provincia', 'departamento'], 'string', 'max' => 30],
            [['latitud', 'meridiano'], 'string', 'max' => 15],
            [['codpro'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'direc' => Yii::t('base.names', 'Address'),
            'nomlug' => Yii::t('base.names', 'Place Name'),
            'distrito' => Yii::t('base.names', 'District'),
            'provincia' => Yii::t('base.names', 'Province'),
            'departamento' => Yii::t('base.names', 'Departament'),
            'latitud' => Yii::t('base.names', 'Latitude'),
            'meridiano' => Yii::t('base.names', 'Meridian'),
            'codpro' => Yii::t('base.names', 'Vendor Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugares()
    {
        return $this->hasMany(Lugares::className(), ['direcciones_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return DireccionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DireccionesQuery(get_called_class());
    }
}
