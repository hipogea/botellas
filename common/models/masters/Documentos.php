<?php

namespace common\models\masters;
use common\models\base\modelBaseTrait;
use common\models\base\modelBase;
use common\models\masters\Parametrosdocu;
use Yii;

/**
 * This is the model class for table "{{%documentos}}".
 *
 * @property string $codocu
 * @property string $desdocu
 * @property string $clase
 * @property string $tipo
 * @property string $tabla
 * @property string $abreviatura
 * @property string $prefijo
 * @property string $escomprobante Define si es un comprobante 
 * @property int $idreportedefault Indica el id del reporte por defaul, sirve para visualizar un documento 
 */
class Documentos extends modelBase
{
    use modelBaseTrait;
    /**
     * {@inheritdoc}
     */
    
    
    public static function tableName()
    {
        return '{{%documentos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codocu', 'desdocu'], 'required'],
             [['codocu'], 'match', 'pattern' => '/[1-9]{1}[0-9]{2}/','message'=>yii::t('base.errors','The {field} doesn\'t match with format')],
            [['idreportedefault'], 'integer'],
            [['codocu'], 'string', 'max' => 3],
            [['desdocu', 'tabla'], 'string', 'max' => 60],
            [['clase', 'escomprobante'], 'string', 'max' => 1],
            [['tipo'], 'string', 'max' => 2],
            [['abreviatura'], 'string', 'max' => 5],
            [['prefijo'], 'string', 'max' => 4],
            [['codocu'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codocu' => 'Codocu',
            'desdocu' => 'Desdocu',
            'clase' => 'Clase',
            'tipo' => 'Tipo',
            'tabla' => 'Tabla',
            'abreviatura' => 'Abreviatura',
            'prefijo' => 'Prefijo',
            'escomprobante' => 'Escomprobante',
            'idreportedefault' => 'Idreportedefault',
        ];
    }
    
     public function afterSave($insert,$changedAttributes){
        //if($insert)
        //$this->loadParametros();
        return parent::afterSave($insert,$changedAttributes);
    }
    
    private function loadParametros(){
      $params=Parametros::find()->where(['activo' => '1', 'flag' => 'D'])->all();
      $codocu=$this->codocu;
      //var_dump($centro);die();
      
      foreach($params as $fila){
          $attributes=['codocu'=>$codocu,
              'codparam'=>$fila->codparam];
          Parametrosdocu::firstOrCreateStatic($attributes);
      }
   }
}
