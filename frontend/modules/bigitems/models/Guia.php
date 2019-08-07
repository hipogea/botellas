<?php

namespace frontend\modules\bigitems\models;
use common\models\masters\Direcciones;
use common\models\masters\Centros;
use common\models\masters\Clipro;
use Yii;

/**
 * This is the model class for table "{{%bigitems_guia}}".
 *
 * @property int $id
 * @property string $numgui
 * @property string $descripcion
 * @property string $serie
 * @property string $codpro
 * @property string $codpro_tran
 * @property string $fecha
 * @property string $fecha_tran
 * @property string $codestado
 * @property string $chofer
 * @property string $codmotivo
 * @property string $placa
 * @property string $confvehicular
 * @property string $brevete
 * @property int $ptopartida_id
 * @property int $ptollegada_id
 * @property string $codcen
 * @property string $codocu
 * @property string $comentario
 * @property string $essalida
 *
 * @property Direcciones $ptollegada
 * @property Centros $codcen0
 * @property Documentos $codocu0
 * @property Direcciones $ptopartida
 * @property Clipro $codpro0
 * @property Clipro $codproTran
 */
class Guia extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bigitems_guia}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numgui', 'serie', 'codpro', 'codpro_tran', 'fecha', 'fecha_tran', 'codestado', 'codmotivo', 'codcen', 'codocu', 'essalida'], 'required'],
            [['ptopartida_id', 'ptollegada_id'], 'integer'],
            [['comentario'], 'string'],
            [['numgui', 'fecha', 'fecha_tran', 'confvehicular', 'brevete'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 40],
            [['serie', 'codocu'], 'string', 'max' => 3],
            [['codpro', 'codpro_tran'], 'string', 'max' => 6],
            [['codestado', 'codmotivo'], 'string', 'max' => 2],
            [['chofer'], 'string', 'max' => 15],
            [['placa'], 'string', 'max' => 8],
            [['codcen'], 'string', 'max' => 5],
            [['essalida'], 'string', 'max' => 1],
            [['ptollegada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direcciones::className(), 'targetAttribute' => ['ptollegada_id' => 'id']],
            [['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
            [['ptopartida_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direcciones::className(), 'targetAttribute' => ['ptopartida_id' => 'id']],
            [['codpro'], 'exist', 'skipOnError' => true, 'targetClass' => Clipro::className(), 'targetAttribute' => ['codpro' => 'codpro']],
            [['codpro_tran'], 'exist', 'skipOnError' => true, 'targetClass' => Clipro::className(), 'targetAttribute' => ['codpro_tran' => 'codpro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('bigitems.labels', 'ID'),
            'numgui' => Yii::t('bigitems.labels', 'Numgui'),
            'descripcion' => Yii::t('bigitems.labels', 'Descripcion'),
            'serie' => Yii::t('bigitems.labels', 'Serie'),
            'codpro' => Yii::t('bigitems.labels', 'Codpro'),
            'codpro_tran' => Yii::t('bigitems.labels', 'Codpro Tran'),
            'fecha' => Yii::t('bigitems.labels', 'Fecha'),
            'fecha_tran' => Yii::t('bigitems.labels', 'Fecha Tran'),
            'codestado' => Yii::t('bigitems.labels', 'Codestado'),
            'chofer' => Yii::t('bigitems.labels', 'Chofer'),
            'codmotivo' => Yii::t('bigitems.labels', 'Codmotivo'),
            'placa' => Yii::t('bigitems.labels', 'Placa'),
            'confvehicular' => Yii::t('bigitems.labels', 'Confvehicular'),
            'brevete' => Yii::t('bigitems.labels', 'Brevete'),
            'ptopartida_id' => Yii::t('bigitems.labels', 'Ptopartida ID'),
            'ptollegada_id' => Yii::t('bigitems.labels', 'Ptollegada ID'),
            'codcen' => Yii::t('bigitems.labels', 'Codcen'),
            'codocu' => Yii::t('bigitems.labels', 'Codocu'),
            'comentario' => Yii::t('bigitems.labels', 'Comentario'),
            'essalida' => Yii::t('bigitems.labels', 'Essalida'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtollegada()
    {
        return $this->hasOne(Direcciones::className(), ['id' => 'ptollegada_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodcen0()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodocu0()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtopartida()
    {
        return $this->hasOne(Direcciones::className(), ['id' => 'ptopartida_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodpro0()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodproTran()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro_tran']);
    }

    /**
     * {@inheritdoc}
     * @return GuiaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GuiaQuery(get_called_class());
    }
}
