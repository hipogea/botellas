<?php

namespace frontend\modules\bigitems\models\viewsmodels;

use Yii;

/**
 * This is the model class for table "{{%vw_docbotellas}}".
 *
 * @property string $numero
 * @property string $codcen
 * @property string $codestadodoc
 * @property string $descripcion
 * @property string $fectran
 * @property string $fecdocu
 * @property string $essalida
 * @property string $codenvio
 * @property string $despro
 * @property string $rucpro
 * @property string $codigo
 * @property string $numdocuref
 * @property string $codestadodet
 * @property string $direcpartida
 * @property string $distritopartida
 * @property string $provinciapartida
 * @property string $direcllegada
 * @property string $distritollegada
 * @property string $provinciallegada
 * @property string $desactivo
 * @property string $apvendedor
 * @property string $nombrevendededor
 * @property string $aptrans
 * @property string $nombretrans
 */
class VwDocbotellas extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
     public $dateorTimeFields=[
        'fecdocu'=>self::_FDATE,
        'fectran'=>self::_FTIME,
        'fectran1'=>self::_FDATE
        ];
    public $booleanFields=['essalida'];
    public $fectran1;
    public $fecdocu1;
    public static function tableName()
    {
        return '{{%vw_docbotellas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'codcen', 'codestadodoc', 'descripcion', 'fecdocu', 'essalida', 'codenvio', 'despro', 'rucpro', 'codigo', 'codestadodet', 'apvendedor', 'nombrevendededor', 'aptrans', 'nombretrans'], 'required'],
            [['numero', 'fectran', 'fecdocu'], 'string', 'max' => 10],
            [['codcen'], 'string', 'max' => 5],
            [['codestadodoc', 'codenvio', 'codestadodet'], 'string', 'max' => 2],
            [['descripcion', 'desactivo', 'apvendedor', 'nombrevendededor', 'aptrans', 'nombretrans'], 'string', 'max' => 40],
            [['essalida'], 'string', 'max' => 1],
            [['despro'], 'string', 'max' => 60],
            [['rucpro'], 'string', 'max' => 15],
            [['codigo', 'numdocuref'], 'string', 'max' => 16],
            [['direcpartida', 'direcllegada'], 'string', 'max' => 80],
            [['distritopartida', 'distritollegada'], 'string', 'max' => 25],
            [['provinciapartida', 'provinciallegada'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'numero' => Yii::t('bigitems.labels', 'Numero'),
            'codcen' => Yii::t('bigitems.labels', 'Codcen'),
            'codestadodoc' => Yii::t('bigitems.labels', 'Codestadodoc'),
            'descripcion' => Yii::t('bigitems.labels', 'Descripcion'),
            'fectran' => Yii::t('bigitems.labels', 'Fectran'),
            'fecdocu' => Yii::t('bigitems.labels', 'Fecdocu'),
            'essalida' => Yii::t('bigitems.labels', 'Essalida'),
            'codenvio' => Yii::t('bigitems.labels', 'Codenvio'),
            'despro' => Yii::t('bigitems.labels', 'Despro'),
            'rucpro' => Yii::t('bigitems.labels', 'Rucpro'),
            'codigo' => Yii::t('bigitems.labels', 'Codigo'),
            'numdocuref' => Yii::t('bigitems.labels', 'Numdocuref'),
            'codestadodet' => Yii::t('bigitems.labels', 'Codestadodet'),
            'direcpartida' => Yii::t('bigitems.labels', 'Direcpartida'),
            'distritopartida' => Yii::t('bigitems.labels', 'Distritopartida'),
            'provinciapartida' => Yii::t('bigitems.labels', 'Provinciapartida'),
            'direcllegada' => Yii::t('bigitems.labels', 'Direcllegada'),
            'distritollegada' => Yii::t('bigitems.labels', 'Distritollegada'),
            'provinciallegada' => Yii::t('bigitems.labels', 'Provinciallegada'),
            'desactivo' => Yii::t('bigitems.labels', 'Desactivo'),
            'apvendedor' => Yii::t('bigitems.labels', 'Apvendedor'),
            'nombrevendededor' => Yii::t('bigitems.labels', 'Nombrevendededor'),
            'aptrans' => Yii::t('bigitems.labels', 'Aptrans'),
            'nombretrans' => Yii::t('bigitems.labels', 'Nombretrans'),
        ];
    }

    public function getClipro()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro']);
    }
    /**
     * {@inheritdoc}
     * @return VwDocbotellasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VwDocbotellasQuery(get_called_class());
    }
    
    
    public static function sum($id, $namefield){
       return self::find()->where(['=','id',$id])->sum($namefield);
    }
    public static function count($id, $namefield){
       return self::find()->where(['=','id',$id])->count($namefield);
    }
    public static  function avg($id, $namefield){
       return self::find()->where(['=','id',$id])->avg($namefield);
    }
}
