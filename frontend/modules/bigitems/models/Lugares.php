<?php

namespace frontend\modules\bigitems\models;

use common\models\masters\Direcciones;
use common\helpers\h;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "{{%lugares}}".
 *
 * @property int $id
 * @property int $direcciones_id
 * @property string $nombre
 * @property string $tienerecepcion
 * @property string $tipo
 *
 * @property Activos[] $activos
 * @property Activos[] $activos0
 * @property Grupos[] $grupos
 * @property Logtransporte[] $logtransportes
 * @property Logtransporte[] $logtransportes0
 * @property \helpersDirecciones $direcciones
 */
class Lugares extends \common\models\base\modelBase {

    /**
     * {@inheritdoc}
     */
    public static function tableNamex() {
        return '{{%lugarevvs}}';
    }

    public static function tableName() {
        return '{{%lugares}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['direcciones_id'], 'integer'],
                [['nombre'], 'string', 'max' => 40],
                [['tienerecepcion', 'tipo'], 'string', 'max' => 1],
                [['direcciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direcciones::className(), 'targetAttribute' => ['direcciones_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'direcciones_id' => 'Direcciones ID',
            'nombre' => 'Nombre',
            'tienerecepcion' => 'Tienerecepcion',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivos() {
        return $this->hasMany(Activos::className(), ['lugar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivos0() {
        return $this->hasMany(Activos::className(), ['lugar_original_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos() {
        return $this->hasMany(Grupos::className(), ['lugares_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogtransportes() {
        return $this->hasMany(Logtransporte::className(), ['lugar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogtransportes0() {
        return $this->hasMany(Logtransporte::className(), ['lugar_anterior_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirecciones() {
        return $this->hasOne(Direcciones::className(), ['id' => 'direcciones_id']);
    }

    /**
     * {@inheritdoc}
     * @return LugaresQuery the active query used by this AR class.
     */
    public static function find() {
        return new LugaresQuery(get_called_class());
    }

    /* Inicilaizar la tabla con un valor */

    public static function insertFirst() {

        if (is_null(Direcciones::find()->one())){
             $message = Yii::t('base.errors', 'Before to use BigItems Module,  first You should fill Adresses table ');
           yii::$app->session->setFlash('success', $message);
           // return h::response()->redirect(Url::toRoute('/settings'));
             return h::response()->redirect(Url::toRoute('/masters/direcciones/create'));
        }
           
        //throw new \yii\base\Exception(Yii::t('base.errors', 'You should fill Adresses table '));

       return static::firstOrCreateStatic([
            'direcciones_id' => Direcciones::find()->one()->id,
            'nombre' => 'Place 1',
            'tienerecepcion' => '0',
            'tipo' => 'A',
        ]);
        
    }

}
