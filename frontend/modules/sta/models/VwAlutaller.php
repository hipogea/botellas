<?php

namespace frontend\modules\sta\models;
use frontend\modules\sta\staModule;
use Yii;

/**
 * This is the model class for table "{{%vw_alutaller}}".
 *
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property string $codfac
 * @property string $dni
 * @property string $correo
 * @property string $celulares
 * @property string $fijos
 * @property int $id
 * @property string $codalu
 * @property int $talleres_id
 * @property string $fingreso
 * @property string $codtra
 */
class VwAlutaller extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
     public $dateorTimeFields=[
        'fecna'=>self::_FDATE,
       
        ];
    public $dateOrTimeFields=['fecna'];
    public static function tableName()
    {
        return '{{%vw_alutaller}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'talleres_id'], 'integer'],
            [['codalu', 'talleres_id'], 'required'],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['codfac'], 'string', 'max' => 8],
            [['dni'], 'string', 'max' => 12],
            [['correo'], 'string', 'max' => 54],
            [['celulares'], 'string', 'max' => 23],
            [['fijos', 'codalu'], 'string', 'max' => 14],
            [['fingreso'], 'string', 'max' => 10],
            [['codtra'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ap' => Yii::t('sta.labels', 'Ap'),
            'am' => Yii::t('sta.labels', 'Am'),
            'nombres' => Yii::t('sta.labels', 'Nombres'),
            'codfac' => Yii::t('sta.labels', 'Codfac'),
            'dni' => Yii::t('sta.labels', 'Dni'),
            'correo' => Yii::t('sta.labels', 'Correo'),
            'celulares' => Yii::t('sta.labels', 'Celulares'),
            'fijos' => Yii::t('sta.labels', 'Fijos'),
            'id' => Yii::t('sta.labels', 'ID'),
            'codalu' => Yii::t('sta.labels', 'Codalu'),
            'talleres_id' => Yii::t('sta.labels', 'Talleres ID'),
            'fingreso' => Yii::t('sta.labels', 'Fingreso'),
            'codtra' => Yii::t('sta.labels', 'Tutor'),
             'nomcur' => Yii::t('sta.labels', 'Curso'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return VwAlutallerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VwAlutallerQuery(get_called_class());
    }
    
    public function getUrlImage(){
       if($this->hasAttachments()){        
           return $this->files[0]->getUrl();
       }else{
           return staModule::getPathImage($this->codalu);        
       }
    }
    
    public function getPrimaryKey($asArray = false) {
        return $this->id;
    }
}
