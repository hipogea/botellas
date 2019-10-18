<?php

namespace frontend\modules\sta\models;

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
class Entregas extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public $dateorTimeFields=[
       'fecha'=> self::_FDATE,
         'fechacorte'=> self::_FDATE,
       ];
    
    public static function tableName()
    {
        return '{{%sta_entregas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codfac','fecha','codperiodo','fechacorte'], 'required'],
            [['codfac'], 'string', 'max' => 8],
            [['fecha', 'fechacorte'], 'string', 'max' => 10],
            [['version'], 'string', 'max' => 1],
            [['codperiodo'], 'string', 'max' => 6],
          
            [['codfac'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['codfac' => 'codfac']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'codfac' => Yii::t('sta.labels', 'Codfac'),
            'fecha' => Yii::t('sta.labels', 'Fecha'),
            'fechacorte' => Yii::t('sta.labels', 'Fechacorte'),
            'version' => Yii::t('sta.labels', 'Version'),
            'codperiodo' => Yii::t('sta.labels', 'Codperiodo'),
            'codalu' => Yii::t('sta.labels', 'Codalu'),
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
}
