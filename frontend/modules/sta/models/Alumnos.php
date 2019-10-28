<?php

namespace frontend\modules\sta\models;
use frontend\modules\sta\models\Carreras;
use frontend\modules\sta\staModule;
use frontend\modules\sta\interfaces\FotografiaInterface;
use common\models\Profile;
use common\interfaces\PersonInterface;
use common\helpers\h;
use Carbon\Carbon;
use common\helpers\BaseHelper;
use Yii;

/**
 * This is the model class for table "{{%sta_alu}}".
 *
 * @property int $id
 * @property int $profile_id
 * @property string $codcar
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property string $fecna
 * @property string $codalu
 * @property string $dni
 * @property string $domicilio
 * @property string $codist
 * @property string $codprov
 * @property string $codep
 * @property string $sexo
 *
 * @property StaCarreras $codcar0
 * @property Profile $profile
 */
class Alumnos extends \common\models\base\modelBase implements PersonInterface , FotografiaInterface
{
    
     public $dateorTimeFields=[
        'fecna'=>self::_FDATE,
       
        ];
    
    /**
     * {@inheritdoc}
     */
    const SCENARIO_SOLO='solo';
    const SCENARIO_BATCH='batch';//varios datos 
    const SCENARIO_BATCH_MEDIO='import_medio'; //datos pocos
    const SCENARIO_BATCH_MINIMO='import_minimo'; //datos pocos
    public static function tableName()
    {
        return '{{%sta_alu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            [['codalu', 'codcar', 'ap', 'am', 'nombres'], 'required'],
            [['profile_id'], 'integer'],
             [['celulares'], 'integer'],
            [['codcar'], 'string', 'max' => 6],
             [['codfac'], 'string', 'max' => 8],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['fecna'], 'string', 'max' => 10],
            [['codalu'], 'string', 'max' => 14],
             ['codalu', 'match', 'pattern' => h::gsetting('sta', 'regexcodalu')],
             ['codalu','unique','message'=>yii::t('base.errors','Este valor ya está registrado')],
            ['dni','match', 'pattern' => h::gsetting('general', 'formatoDNI')],
            ['dni','unique','message'=>yii::t('base.errors','Este valor ya está registrado')],
            [['domicilio'], 'string', 'max' => 120],
            [['codist', 'codprov', 'codep'], 'string', 'max' => 9],
            [['sexo'], 'string', 'max' => 1],
            [['correo'], 'email'],
            [['codcar'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['codcar' => 'codcar']],
            //[['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
         /*Escenario para carga masiva*/
            
            ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SOLO] = ['profile_id'];
        $scenarios[self::SCENARIO_BATCH] = [ 'codalu','codcar', 'ap', 'am', 'nombres', 'dni','domicilio','correo','celulares','fijos'];
         $scenarios[self::SCENARIO_BATCH_MEDIO] = ['codalu', 'codcar', 'ap', 'am', 'nombres', 'dni','domicilio','celulares'];
       // $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'profile_id' => Yii::t('sta.labels', 'Profile'),
            'codcar' => Yii::t('sta.labels', 'Cod Esp'),
            'ap' => Yii::t('sta.labels', 'Ap Paterno'),
            'am' => Yii::t('sta.labels', 'A Materno'),
            'nombres' => Yii::t('sta.labels', 'Nombres'),
            'fecna' => Yii::t('sta.labels', 'F. Nac'),
            'codalu' => Yii::t('sta.labels', 'Código'),
            'dni' => Yii::t('sta.labels', 'DNI'),
            'domicilio' => Yii::t('sta.labels', 'Domicilio'),
            'codist' => Yii::t('sta.labels', 'Distrito'),
            'codprov' => Yii::t('sta.labels', 'Provincia'),
            'codep' => Yii::t('sta.labels', 'Dpto'),
            'sexo' => Yii::t('sta.labels', 'Sexo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodcar()
    {
        return $this->hasOne(Carreras::className(), ['codcar' => 'codcar']);
    }
    
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['codfac' => 'codfac']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    /**
     * {@inheritdoc}
     * @return AlumnosQuery the active query used by this AR class.
     */
    public static function find()
    {
        /*$query= new AlumnosQuery(get_called_class());
        return $query->andWhere(['in',
              'codfac', UserFacultades::filterFacultades()
               ]);*/
        return new AlumnosQuery(get_called_class());
    }
    
    /*public static function findByCondition($condition){
        return parent::findByCondition($condition)->andWhere(
              ['in',
              'codfac', UserFacultades::filterFacultades()
               ]);
    }*/
    
     public function name(){
          return $this->nombres;
        }  
  public function lastName(){
          return $this->ap;
        }  
  public function age(){
          return $this->toCarbon('fecna')->age; //
        }  
  public function docsIdentity(){
         return [
             h::AdocId()[BaseHelper::DOC_DNI]=>$this->dni,
              //h::AdocId()[BaseHelper::DOC_PASAPORTE]=>$this->pasaporte,
              //h::AdocId()[BaseHelper::DOC_PPT]=>$this->ppt,
             // h::AdocId()[BaseHelper::DOC_BREVETE]=>$this->ppt,
             ];
        }  
        
        
  public function address(){
          return $this->domicilio;
        } 
        
        
  public function fenac(){
 return $this->toCarbon('fenac'); 
        }  
        
        
     public function IsBirthDay(){
         //$hoy=Carbon::now();
 return Carbon::now()->isBirthday($this->toCarbon('fenac')); 
        }  
        
        
        
     public function fullName($asc=TRUE,$ucase=true,$delimiter='-'){       
         $strname=($asc)?$this->nombres.$delimiter.$this->ap.$delimiter.$this->am:$strname= $this->ap.$delimiter.$this->am.$delimiter.$this->nombres;
         $strname= ($ucase)?\yii\helpers\StringHelper::mb_ucwords($strname):$strname;
       return str_replace(' ',$delimiter, $strname);
     }
    
    public function beforeSave($insert){
        if($insert){
            $this->codfac=Carreras::find()->where(['codcar'=>$this->codcar])->one()->codfac;
        }
        return parent::beforeSave($insert);
    }
    
    
    public function getCarrera()
    {
        return $this->hasOne(Carreras::className(), ['codcar' => 'codcar']);
    }

    public function getUrlImage(){
       if($this->hasAttachments()){        
           return $this->files[0]->getUrl();
       }else{
           return staModule::getPathImage($this->codalu);        
       }
   }
    
}
