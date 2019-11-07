<?php

namespace frontend\modules\sigi\models;

use Yii;
use common\models\masters\Clipro;
/**
 * This is the model class for table "{{%sigi_apoderados}}".
 *
 * @property int $id
 * @property int $edificio_id
 * @property string $codpro
 * @property string $facturaigv
 * @property string $permite1
 * @property string $permite2
 * @property string $detalles
 * @property string $permiteventa
 * @property string $permitealquiler
 *
 * @property Clipro $codpro0
 */
class SigiApoderados extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_apoderados}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['edificio_id', 'codpro'], 'required'],
            [['edificio_id'], 'integer'],
            [['detalles'], 'string'],
            [['codpro'], 'string', 'max' => 6],
            [['facturaigv', 'permite1', 'permite2', 'permiteventa', 'permitealquiler'], 'string', 'max' => 1],
            [['codpro'], 'exist', 'skipOnError' => true, 'targetClass' => Clipro::className(), 'targetAttribute' => ['codpro' => 'codpro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sigi.labels', 'ID'),
            'edificio_id' => Yii::t('sigi.labels', 'Edificio ID'),
            'codpro' => Yii::t('sigi.labels', 'Codpro'),
            'facturaigv' => Yii::t('sigi.labels', 'Facturaigv'),
            'permite1' => Yii::t('sigi.labels', 'Permite1'),
            'permite2' => Yii::t('sigi.labels', 'Permite2'),
            'detalles' => Yii::t('sigi.labels', 'Detalles'),
            'permiteventa' => Yii::t('sigi.labels', 'Permiteventa'),
            'permitealquiler' => Yii::t('sigi.labels', 'Permitealquiler'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClipro()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro']);
    }

    /**
     * {@inheritdoc}
     * @return SigiApoderadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiApoderadosQuery(get_called_class());
    }
}
