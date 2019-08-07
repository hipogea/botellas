<?php

namespace common\models\config;

use common\models\base\modelBase;
use common\models\masters\Centros;
use common\models\config\Parametros;
use common\models\config\ParametrosSearch;
use Yii;

/**
 * This is the model class for table "{{%parametroscentros}}".
 *
 * @property int $id
 * @property string $codparam
 * @property string $codcen
 * @property string $valor
 * @property string $valor2
 *
 * @property Parametros $codparam0
 * @property Centros $codcen0
 */
class Parametroscentros extends modelBase {

    private $_typedata;
    private $_longitud;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%parametroscentros}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        $reglas= [
                [['codparam', 'codcen'], 'required'],
                [['valor'], 'validateValue'],
                [['codparam', 'codcen'], 'string', 'max' => 5],
                [['codparam'], 'exist', 'skipOnError' => true, 'targetClass' => Parametros::className(), 'targetAttribute' => ['codparam' => 'codparam']],
                [['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
        ];
        return   \yii\helpers\ArrayHelper::merge(
              parent::ruleBlockedFields(),
               $reglas );
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'codparam' => Yii::t('base.names', 'Codparam'),
            'codcen' => Yii::t('base.names', 'Codcen'),
            'valor' => Yii::t('base.names', 'Valor'),
            'valor2' => Yii::t('base.names', 'Valor2'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametros() {
        return $this->hasOne(Parametros::className(), ['codparam' => 'codparam']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentros() {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * {@inheritdoc}
     * @return ParametroscentrosQuery the active query used by this AR class.
     */
    public static function find() {
        return new ParametroscentrosQuery(get_called_class());
    }

    public function afterFind() {
        $this->_typedata = $this->parametros->tipodato;
        $this->_longitud = $this->parametros->longitud;
        parent::afterFind();
    }

    public function getValue() {
        // if($this->_typedata=='C')//TEXTO
        if ($this->_typedata == 'C') { //NUMNERICO
            return $this->valor;
        }

        if ($this->_typedata == 'N') { //NUMNERICO
            return (is_null($this->valor) or ! is_numeric($this->valor)) ? 0 : $this->valor + 0;
        }
        if ($this->_typedata == 'B') {//BOOLEANO{
            return (is_null($this->valor) or $this->valor == '0' or empty($this->valor)) ? false : true;
        }
    }

    /* validador de datos */

    public function validateValue($attribute, $params) {
        $valor = $this->{$attribute};

        if (is_null($valor))
            $this->addError($attribute, yii::t('base.errors', 'The field "{namefield}" is null', ['namefield' => $attribute]));

        if ($this->_typedata == 'N' && (
                empty($valor) or ! is_numeric($valor)
                or strlen(trim($valor)) > $this->_longitud
                )
        ) { //NUMNERICO
            $this->addError($attribute, yii::t('base.errors', 'The value for  "{namefield}" is incorrect. Review Type or Lenght Conditions', ['namefield' => $attribute]));
        }
        if ($this->_typedata == 'C' && (
                empty($valor)
                or strlen(trim($valor)) > $this->_longitud
                )
        ) { //NUMNERICO
            $this->addError($attribute, yii::t('base.errors', 'The value for  "{namefield}" is incorrect. Review Type or Lenght Conditions', ['namefield' => $attribute]));
        }


        if ($this->_typedata == 'B' && (
                empty($valor)
                or strlen(trim($valor)) > 1 or ! in_array(strlen(trim($valor)), ['1', '0'])
                )
        ) { //NUMNERICO
            $this->addError($attribute, yii::t('base.errors', 'The value for  "{namefield}" expects boolean Type.', ['namefield' => $attribute]));
        }
        //$this->addError($attribute,yii::t('base.errors','The field "{namefield}" can\'t be modified, other records depend on it',['namefield'=>$attribute]));
    }

}
