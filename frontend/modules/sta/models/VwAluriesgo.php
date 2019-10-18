<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%vw_aluriesgo}}".
 *
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property string $codfac
 * @property string $dni
 * @property string $celulares
 * @property string $fijos
 * @property int $id
 * @property string $codcur
 * @property string $codalu
 * @property int $nveces
 * @property string $codperiodo
 * @property string $codcar
 * @property string $nomcur
 * @property int $creditos
 * @property string $electivo
 * @property int $ciclo
 */
class VwAluriesgo extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vw_aluriesgo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nveces', 'creditos', 'ciclo'], 'integer'],
            [['codcur', 'codalu', 'codperiodo'], 'required'],
            [['ap', 'am', 'nombres', 'nomcur'], 'string', 'max' => 40],
            [['codfac'], 'string', 'max' => 8],
            [['dni'], 'string', 'max' => 12],
            [['celulares'], 'string', 'max' => 23],
            [['fijos', 'codalu'], 'string', 'max' => 14],
            [['codcur'], 'string', 'max' => 10],
            [['codperiodo'], 'string', 'max' => 7],
            [['codcar'], 'string', 'max' => 6],
            [['electivo'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ap' => Yii::t('sta.labels', 'Ap'),
            'am' => Yii::t('sta.labels', 'Am'),
            'nombres' => Yii::t('sta.labels', 'Nombres'),
            'codfac' => Yii::t('sta.labels', 'Codfac'),
            'dni' => Yii::t('sta.labels', 'Dni'),
            'celulares' => Yii::t('sta.labels', 'Celulares'),
            'fijos' => Yii::t('sta.labels', 'Fijos'),
            'id' => Yii::t('sta.labels', 'ID'),
            'codcur' => Yii::t('sta.labels', 'Codcur'),
            'codalu' => Yii::t('sta.labels', 'Codalu'),
            'nveces' => Yii::t('sta.labels', 'Nveces'),
            'codperiodo' => Yii::t('sta.labels', 'Codperiodo'),
            'codcar' => Yii::t('sta.labels', 'Codcar'),
            'nomcur' => Yii::t('sta.labels', 'Nomcur'),
            'creditos' => Yii::t('sta.labels', 'Creditos'),
            'electivo' => Yii::t('sta.labels', 'Electivo'),
            'ciclo' => Yii::t('sta.labels', 'Ciclo'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return VwAluriesgoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VwAluriesgoQuery(get_called_class());
    }
}
