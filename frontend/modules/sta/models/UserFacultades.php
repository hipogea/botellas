<?php

namespace frontend\modules\sta\models;
use yii\db\Query;
use common\helpers\h;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "{{%sta_user_facultades}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $codfac
 * @property string $activa
 *
 * @property StaFacultades $codfac0
 */
class UserFacultades extends \common\models\base\modelBase
{
    public $booleanFields=['activa'];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_user_facultades}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['codfac'], 'string', 'max' => 6],
            [['activa'], 'string', 'max' => 1],
            [['codfac'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['codfac' => 'codfac']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'user_id' => Yii::t('sta.labels', 'User ID'),
            'codfac' => Yii::t('sta.labels', 'Codfac'),
            'activa' => Yii::t('sta.labels', 'Activa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['codfac' => 'codfac']);
    }

    /**
     * {@inheritdoc}
     * @return UserFacultadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        
          return new \yii\db\ActiveQuery(get_called_class());  
       
        
    }
    
   
    
    /*Refresca los valores de la tabla 
     * segun se hayan agregado faultades 
     * o falte algun registro 
     */
    public static function refreshTableByUser($iduser=null){
        if(is_null($iduser))
        $iduser=h::userId();
       $facultades=static::idFacultades();
       //var_dump($facultades);die();
     foreach($facultades as $codigofac){
          static::firstOrCreateStatic([
                    'user_id'=>$iduser,
                     'codfac'=>$codigofac['codfac'],
                     //rr'activa'=>'0',
                    ]);
      }
      return $facultades;
    }
    
    private static function query(){
        return new Query;
    }
    /*
    private static function tableUser(){
        return h::user()->identity->tableName();
    }*/
    private static function idFacultades(){
        return static::query()->select('codfac')->
            from(Facultades::tableName())
              ->all();
    }
    /* private static function idUsers(){
        return static::query()->select('id')->
            from(static::tableUser())
              ->where(
                      ['status'=>
                        \common\models\User::STATUS_ACTIVE
                      ])->all();
    }*/
    
    
   /*Devuelve un data provider de lso facultades user por usuario 
    * Observe que hace reerencia a la clase Parametroscentrosdocu tabla
    *   'parametrosdocucentros'
    */
   public static function providerFacus($iduser=null){
            return new ActiveDataProvider([
                'query' =>static::find()->where(['user_id'=>is_null($iduser)?h::userId():$iduser]),
                'pagination' => [
                    'pageSize' => 20,
                            ],
                                    ]);
        } 
    
        
        public static function providerFacusAll($iduser=null){
          
            return new ActiveDataProvider([
                'query' =>static::find(false)->where(['user_id'=>is_null($iduser)?h::userId():$iduser]),
                'pagination' => [
                    'pageSize' => 20,
                            ],
                                    ]);
        } 
        
   public static function filterFacultades($iduser=null){
      return static::find()->
               select('codfac')->
               andWhere(['user_id'=>is_null($iduser)?h::userId():$iduser,'activa'=>'1'])->asArray()->column();
   }     
        
}
