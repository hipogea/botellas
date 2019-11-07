<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%vw_sta_tutores}}".
 *
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property int $trabajador_id
 * @property int $id
 * @property int $talleres_id
 * @property string $codtra
 * @property string $calificacion
 * @property int $nalumnos
 * @property int $taller_id
 * @property string $numero
 * @property string $codfac
 * @property string $descripcion
 * @property string $codperiodo
 * @property string $codocu
 */
class VwStaTutores extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vw_sta_tutores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ap', 'am', 'nombres', 'talleres_id', 'codtra', 'numero', 'descripcion', 'codocu'], 'required'],
            [['trabajador_id', 'id', 'talleres_id', 'nalumnos', 'taller_id'], 'integer'],
            [['ap', 'am', 'nombres', 'descripcion'], 'string', 'max' => 40],
            [['codtra', 'codperiodo'], 'string', 'max' => 6],
            [['calificacion'], 'string', 'max' => 1],
            [['numero', 'codfac'], 'string', 'max' => 8],
            [['codocu'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ap' => Yii::t('sigi.labels', 'Ap'),
            'am' => Yii::t('sigi.labels', 'Am'),
            'nombres' => Yii::t('sigi.labels', 'Nombres'),
            'trabajador_id' => Yii::t('sigi.labels', 'Trabajador ID'),
            'id' => Yii::t('sigi.labels', 'ID'),
            'talleres_id' => Yii::t('sigi.labels', 'Talleres ID'),
            'codtra' => Yii::t('sigi.labels', 'Codtra'),
            'calificacion' => Yii::t('sigi.labels', 'Calificacion'),
            'nalumnos' => Yii::t('sigi.labels', 'Nalumnos'),
            'taller_id' => Yii::t('sigi.labels', 'Taller ID'),
            'numero' => Yii::t('sigi.labels', 'Numero'),
            'codfac' => Yii::t('sigi.labels', 'Codfac'),
            'descripcion' => Yii::t('sigi.labels', 'Descripcion'),
            'codperiodo' => Yii::t('sigi.labels', 'Codperiodo'),
            'codocu' => Yii::t('sigi.labels', 'Codocu'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return VwStaTutoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VwStaTutoresQuery(get_called_class());
    }
}
