<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_periodos}}".
 *
 * @property string $codperiodo
 * @property string $periodo
 * @property string $activa
 */
class Periodos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_periodos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['codperiodo', 'safe'],
             ['codperiodo', 'unique'],
            [['codperiodo'], 'string', 'max' => 7],
            [['periodo'], 'string', 'max' => 40],
            [['activa'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codperiodo' => Yii::t('sta.labels', 'Codperiodo'),
            'periodo' => Yii::t('sta.labels', 'Periodo'),
            'activa' => Yii::t('sta.labels', 'Activa'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return StaPeriodosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PeriodosQuery(get_called_class());
    }
}
