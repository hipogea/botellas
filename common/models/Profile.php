<?php

namespace common\models;
use common\helpers\h;
use common\helpers\FileHelper;
use frontend\modules\sta\helpers\comboHelper;
use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $names
 * @property string $photo
 * @property string $detalle
 *
 * @property User $user
 */
class Profile extends \common\models\base\modelBase
{
   const SCENARIO_INTERLOCUTOR='tipo';
    public $interlocutor='';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    
    public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => \nemmo\attachments\behaviors\FileBehavior::className()
		]
		
	];
}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['photo', 'detalle'], 'string'],
            [['names'], 'string', 'max' => 60],
             [['names','duration','durationabsolute'], 'safe'],
            [['tipo'],'required','on'=>self::SCENARIO_INTERLOCUTOR],
            [['tipo'],'safe','on'=>self::SCENARIO_INTERLOCUTOR],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INTERLOCUTOR] = ['tipo'];
        //$scenarios[self::SCENARIO_UPDATE_TABULAR] = ['codigo','coditem'];
       // $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'user_id' => Yii::t('base.names', 'User ID'),
            'names' => Yii::t('base.names', 'Names'),
            'photo' => Yii::t('base.names', 'Photo'),
            'detalle' => Yii::t('base.names', 'Detalle'),
            'interlocutor' => Yii::t('base.names', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }
    
    public function getAlu()
    {
        if(h::app()->hasModule('sta')){
             if($this->tipo== \frontend\modules\sta\staModule::USER_ALUMNO){
           \frontend\modules\sta\models\Alumnos::firstOrCreateStatic(['profile_id'=>$this->id],\frontend\modules\sta\models\Alumnos::SCENARIO_SOLO);
               return $this->hasOne(\frontend\modules\sta\models\Alumnos::className(), ['profile_id' => 'id']);
      
             }
                  }else{
            return $this;
        }
       
        
    }
    
   public function afterFind() {
       if(!empty($this->tipo))
       $this->interlocutor= comboHelper::getCboValores('sta.tipoprofile')[$this->tipo];
     // echo "murio"; die();
       parent::afterFind();
      /* if(h::app()->hasModule('sta')){
             if($this->tipo== \frontend\modules\sta\staModule::USER_ALUMNO){
           \frontend\modules\sta\models\Alumnos::firstOrCreateStatic(['profile_id'=>$this->id],\frontend\modules\sta\models\Alumnos::SCENARIO_SOLO);
               //return $this->hasOne(\frontend\modules\sta\models\Alumnos::className(), ['profile_id' => 'id']);
      
            
                  }
    
          }
*/
   
   }
   
   public function hasAtachment(){
       return (count($this->files)>0);
   }
    
   
   public function getUrlImage(){
       if($this->hasAtachment()){
           return $this->files[0]->getUrl();
       }else{
        return $this->sourceExternalImage();
       }
   }
   
   /*Busnca una fuente extena en el modulo sta
    * Esi no encuentra deveulve el defaulr 
    */
   private function sourceExternalImage(){
       if(h::app()->hasModule('sta') && $this->tipo== \frontend\modules\sta\staModule::USER_ALUMNO){
          return \frontend\modules\sta\staModule::getPathImage($this->user->username); 
       }else{
          return  FileHelper::getUrlImageUserGuest();  
       }
   }
   
   
  
             }
