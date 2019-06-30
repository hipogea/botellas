<?php

namespace frontend\modules\bigitems\models;

use Yii;

/**
 * This is the model class for table "{{%bigitems_detdocbotellas}}".
 *
 * @property int $id
 * @property int $doc_id
 * @property string $codigo
 * @property double $tarifa
 * @property string $codocuref
 * @property string $numdocuref
 * @property string $detalle
 * @property string $codestado
 *
 * @property Activos $codigo0
 * @property BigitemsDocbotellas $doc
 */
class Detdocbotellas extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bigitems_detdocbotellas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_id', 'codigo', 'codestado'], 'required'],
            [['doc_id'], 'integer'],
            [['tarifa'], 'number'],
            [['detalle'], 'string'],
            [['codigo', 'numdocuref'], 'string', 'max' => 16],
            [['codocuref'], 'string', 'max' => 3],
            [['codestado'], 'string', 'max' => 2],
            [['codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Activos::className(), 'targetAttribute' => ['codigo' => 'codigo']],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => BigitemsDocbotellas::className(), 'targetAttribute' => ['doc_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('bigitems.labels', 'ID'),
            'doc_id' => Yii::t('bigitems.labels', 'Doc ID'),
            'codigo' => Yii::t('bigitems.labels', 'Codigo'),
            'tarifa' => Yii::t('bigitems.labels', 'Tarifa'),
            'codocuref' => Yii::t('bigitems.labels', 'Codocuref'),
            'numdocuref' => Yii::t('bigitems.labels', 'Numdocuref'),
            'detalle' => Yii::t('bigitems.labels', 'Detalle'),
            'codestado' => Yii::t('bigitems.labels', 'Codestado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivo()
    {
        return $this->hasOne(Activos::className(), ['codigo' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocbotella()
    {
        return $this->hasOne(Docbotellas::className(), ['id' => 'doc_id']);
    }

    /**
     * {@inheritdoc}
     * @return DetdocbotellasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetdocbotellasQuery(get_called_class());
    }
}
