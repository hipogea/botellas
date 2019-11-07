<?php

namespace frontend\modules\sigi\models;

use Yii;

/**
 * This is the model class for table "{{%sigi_grupo_presupuesto}}".
 *
 * @property string $codigo
 * @property string $descripcion
 * @property string $detalle
 *
 * @property SigiBasePrespuesto[] $sigiBasePrespuestos
 */
class SigiGrupoPresupuesto extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_grupo_presupuesto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo','tipo','descripcion'], 'required'],
             [['tipo'], 'safe'],
            [['detalle'], 'string'],
            [['codigo'], 'string', 'max' => 4],
            [['descripcion'], 'string', 'max' => 70],
            [['codigo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo' => Yii::t('sigi.labels', 'Codigo'),
            'descripcion' => Yii::t('sigi.labels', 'Descripcion'),
            'detalle' => Yii::t('sigi.labels', 'Detalle'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSigiBasePrespuestos()
    {
        return $this->hasMany(SigiBasePresupuesto::className(), ['codgrupo' => 'codigo']);
    }

    /**
     * {@inheritdoc}
     * @return SigiGrupoPresupuestoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiGrupoPresupuestoQuery(get_called_class());
    }
}
