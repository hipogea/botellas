<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_interlocutor}}".
 *
 * @property int $id
 * @property int $profile_id
 * @property string $codfac
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property string $fecna
 * @property string $phones
 * @property string $tipo
 */
class StaInterlocutor extends \common\models\base\modelBase
{
  /*
   * Estas constantes definen la identidad de
   * un uusario cualquiera que entre al presente
   * módulo.  Podr{ian preguntarse  ¿Pero esto 
   * no lo defines mejor por los Roles y permisos?
   * Respuesta : No 
   * Porque los roles estan basados en accesos a rutas
   * y tienen atributos de cascada heredadad, la identidad
   * del usuario en este modulo es otra cosa: Esta gobernada
   * por otras reglas de acceso; a nivel de filtros de tabla
   * por ejemplo la facultad;  y cada tipo instancia uan clase 
   * diferente 
   */
    const TYPE_ALUMNO='10';
    const TYPE_ALUMNO_AYUDANTE='20';
     const TYPE_PSICOLOGO='30';
     const TYPE_SOCIAL='40';
        const TYPE_COORDINADOR='50';
         const TYPE_AUTORIDAD='60';
          const TYPE_DOCENTE_TUTOR='70';
        
     
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_interlocutor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profile_id'], 'required'],
            [['profile_id'], 'integer'],
            [['codfac'], 'string', 'max' => 6],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['fecna'], 'string', 'max' => 10],
            [['phones'], 'string', 'max' => 60],
            [['tipo'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'profile_id' => Yii::t('sta.labels', 'Profile ID'),
            'codfac' => Yii::t('sta.labels', 'Codfac'),
            'ap' => Yii::t('sta.labels', 'Ap'),
            'am' => Yii::t('sta.labels', 'Am'),
            'nombres' => Yii::t('sta.labels', 'Nombres'),
            'fecna' => Yii::t('sta.labels', 'Fecna'),
            'phones' => Yii::t('sta.labels', 'Phones'),
            'tipo' => Yii::t('sta.labels', 'Tipo'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return StaInterlocutorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaInterlocutorQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        /*Nos aseguramos que el campo tipo no quede vaci{o
         *esto puede concederle sin querer acceso a todas las facultades*/
        IF($insert && empty($this->tipo))
            $this->tipo=static::TYPE_ALUMNO;
    }
    
    public function getWhereFacultad(){
        if($this->tipo==static::TYPE_AUTORIDAD)
            return ['1'=>'1'];
        return ['codfac'=>$this->codfac];
    }
    
    public function isCompleteData(){
        switch ($this->tipo) {
    case static::TYPE_ALUMNO :
       
        break;
    case static::TYPE_ALUMNO_AYUDANTE:
        echo "i es igual a 1";
        break;
    case static::TYPE_AUTORIDAD:
        echo "i es igual a 2";
        break;
     case static::TYPE_COORDINADOR:
        echo "i es igual a 2";
        break;
     case static::TYPE_DOCENTE_TUTOR:
        echo "i es igual a 2";
        break;
     case static::TYPE_PSICOLOGO:
        echo "i es igual a 2";
        break;
    case static::TYPE_SOCIAL:
        echo "i es igual a 2";
        break;
    default:
       
}
    }
}
