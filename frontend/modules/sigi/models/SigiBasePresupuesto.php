<?php

namespace frontend\modules\sigi\models;

use Yii;

/**
 * This is the model class for table "{{%sigi_base_prespuesto}}".
 *
 * @property int $id
 * @property int $edificio_id
 * @property string $codgrupo
 * @property string $codigo
 * @property string $descripcion
 * @property string $activo
 * @property string $ejercicio
 * @property string $mensual
 * @property string $anual
 * @property string $restringir
 * @property string $acumulado
 *
 * @property SigiGrupoPresupuesto $codgrupo0
 * @property SigiEdificios $edificio
 */
class SigiBasePresupuesto extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_base_prespuesto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['edificio_id', 'codgrupo', 'codigo', 'mensual', 'anual', 'acumulado'], 'required'],
            [['edificio_id'], 'integer'],
            [['detalles'], 'safe'],
            [['mensual', 'anual', 'acumulado'], 'number'],
            [['codgrupo', 'ejercicio'], 'string', 'max' => 4],
            [['codigo'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 40],
            [['activo', 'restringir'], 'string', 'max' => 1],
            [['codgrupo'], 'exist', 'skipOnError' => true, 'targetClass' => SigiGrupoPresupuesto::className(), 'targetAttribute' => ['codgrupo' => 'codigo']],
            [['edificio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Edificios::className(), 'targetAttribute' => ['edificio_id' => 'id']],
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
            'codgrupo' => Yii::t('sigi.labels', 'Codgrupo'),
            'codigo' => Yii::t('sigi.labels', 'Codigo'),
            'descripcion' => Yii::t('sigi.labels', 'Descripcion'),
            'activo' => Yii::t('sigi.labels', 'Activo'),
            'ejercicio' => Yii::t('sigi.labels', 'Ejercicio'),
            'mensual' => Yii::t('sigi.labels', 'Mensual'),
            'anual' => Yii::t('sigi.labels', 'Anual'),
            'restringir' => Yii::t('sigi.labels', 'Restringir'),
            'acumulado' => Yii::t('sigi.labels', 'Acumulado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodgrupo0()
    {
        return $this->hasOne(SigiGrupoPresupuesto::className(), ['codigo' => 'codgrupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEdificio()
    {
        return $this->hasOne(Edificios::className(), ['id' => 'edificio_id']);
    }

    /**
     * {@inheritdoc}
     * @return SigiBasePresupuestoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiBasePresupuestoQuery(get_called_class());
    }
}
