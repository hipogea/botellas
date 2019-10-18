<?php

namespace frontend\modules\import\models;
use frontend\modules\import\components\CSVReader as MyCSVReader;
use common\helpers\h;
use common\behaviors\FileBehavior;
use frontend\modules\import\models\ImportLogcargamasiva;
use Yii;

/**
 * This is the model class for table "{{%import_cargamasiva}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $insercion
 * @property string $escenario
 * @property string $lastimport
 * @property string $descripcion
 * @property string $format
 * @property string $modelo
 *
 * @property ImportCargamasivadet[] $importCargamasivadets
 */
class ImportCargamasiva extends \common\models\base\modelBase
{
  
     const EXTENSION_CSV='csv';
    public $booleanFields=['insercion','tienecabecera'];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%import_cargamasiva}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'insercion', 'escenario', 'descripcion', 'format', 'modelo'], 'required'],
            [['user_id'], 'integer'],
            [['insercion'], 'string', 'max' => 1],
            [['escenario', 'descripcion'], 'string', 'max' => 40],
            [['lastimport'], 'string', 'max' => 18],
            [['format'], 'string', 'max' => 3],
            [['modelo'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('import.labels', 'ID'),
            'user_id' => Yii::t('import.labels', 'User ID'),
            'insercion' => Yii::t('import.labels', 'Insercion'),
            'escenario' => Yii::t('import.labels', 'Escenario'),
            'lastimport' => Yii::t('import.labels', 'Lastimport'),
            'descripcion' => Yii::t('import.labels', 'Descripcion'),
            'format' => Yii::t('import.labels', 'Format'),
            'modelo' => Yii::t('import.labels', 'Modelo'),
        ];
    }
    
       public function behaviors()
        {
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		]
		
	];
            }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImportCargamasivadet()
    {
        return $this->hasMany(ImportCargamasivadet::className(), ['cargamasiva_id' => 'id']);
    }
    
   
    public function getImportLogCargamasiva()
    {
        return $this->hasMany(ImportLogCargamasiva::className(), ['cargamasiva_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ImportCargamasivaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImportCargamasivaQuery(get_called_class());
    }
    
   
    
   
    
    /*Numero de exitos en el log de carga*/
    public function nexitos(){
        if(count($this->nregistros()) >0 ){
          return   ImportLogCargamasiva::find()->
                where(['level'=>'1','user_id'=>h::userId()])->count();
        }else{
            return 0;
        }
    }
    /*
     * Regresa una instancia del modelo asociado
     * en la propiedad 'modelo'
     */
    public function modelAsocc($escenario=null){
       $clase=New $this->modelo;
       if(!is_null($escenario)){
           $clase->setScenario($escenario);
       }else{
           $clase->setScenario($this->escenario);
            
       }
        
      return $clase;
    }
    
    
    private function insertChilds(){
       
            $modeloatratar=$this->modelAsocc();
             $columnas=$modeloatratar->getTableSchema()->columns;
                $i=1;
               // print_r($columnas);die();
              foreach($columnas as $nameField=>$oBCol){ 
                	if($modeloatratar->isAttributeSafe($nameField) &&
                          !$this->existsChildField($nameField) 
                     ){
                            //var_dump($modeloatratar->primaryKey(true),$modeloatratar->getTableSchema()->foreignKeys);die();
                        // if(in_array($nameField ,array_values($modeloatratar->primaryKey(true)))){
                             //$esclave=true;
                            // $orden=array_search($nameField,array_values($modeloatratar->primaryKey(true)))+1;
                         //} else{
                            // $esclave=false;
                             //$orden=$i+count($modeloatratar->primaryKey(true));
                        // } 
                        /* $modeli=New ImportCargamasivadet;
                         $modeli->setAttributes([
                                           'cargamasiva_id'=>$this->id,
                                             'nombrecampo'=>$nameField,
                                            'aliascampo'=>$modeloatratar->getAttributeLabel($nameField),
                                            'sizecampo'=>$oBCol->size,
                                            'activa'=>true,
                                            'requerida'=>$modeloatratar->isAttributeRequired($nameField),
                                            'tipo'=>$oBCol->dbType,
                                            'orden'=>$orden,
                                            'esclave'=>$esclave,
                                            'esforeign'=>in_array($nameField,array_keys($modeloatratar->getTableSchema()->foreignKeys)),
                                            
                                        ]);
                         if(!$modeli->save())
                         {
                             print_r($modeli->getErrors());die();
                         }*/
                            //echo "ahi va ".$nameField."<br>";
                        if(ImportCargamasivadet::firstOrCreateStatic(
                                        [
                                           'cargamasiva_id'=>$this->id,
                                             'nombrecampo'=>$nameField,
                                            'aliascampo'=>$modeloatratar->getAttributeLabel($nameField),
                                            'sizecampo'=>$oBCol->size,
                                            'activa'=>true,
                                            'requerida'=>$modeloatratar->isAttributeRequired($nameField),
                                            'tipo'=>$oBCol->dbType,
                                            'orden'=>$this->ordenCampos()[$nameField]+1,
                                            'esclave'=>in_array($nameField,$modeloatratar->primaryKey(true))?true:false,
                                            'esforeign'=>in_array($nameField,array_keys($modeloatratar->fieldsLink(false))),
                                            
                                        ]))
                                $i++;
                                 }
              } 
    }
    
    public function afterSave($insert,$changedAttributes) {
        if($insert){
           
           $this->insertChilds();
                                       
        }
       return parent::afterSave($insert,$changedAttributes);
    }
  
    
    public function existsChildField($nombrecampo){
        
        return (count($this->childQuery()->andFilterWhere(
                 ['nombrecampo'=>$nombrecampo]
                  )->asArray()->all())>0)?true:false; 
        
        
    }
    /*CARGA LOS ESCENARIOS DEL ODELO ASOCIOADO*/
    public function loadScenariosFromModel(){
       return array_keys($this->modelAsocc()->scenarios());
       
    }
    
    /*
     * El active que3ry de los hijos 
     */
    public function childQuery(){
        return ImportCargamasivadet::find()->
       where(['cargamasiva_id' =>$this->id]);
    }
    
    public function countChilds(){
       return $this->childQuery()->/*where(['activa'=>'1'])->*/count();
    }
    
   public function verifyChilds(){
       $query=$this->childQuery();
       $sinorden=$query->
       andFilterWhere(['orden'=>0])->asArray()->all();
      if(count($sinorden)>0)       
        throw new \yii\base\Exception(Yii::t('import.errors', 'The import records has a field {field} with  \'order\' = 0 ',['field'=>$sinorden[0]['nombrecampo']]));
   
      $sinlongitud=$query->
       andFilterWhere(['sizecampo'=>0])->asArray()->all();
      if(count($sinlongitud)>0)       
        throw new \yii\base\Exception(Yii::t('import.errors', 'The import records has a field {field} with  \'size\' = 0 ',['field'=>$sinlongitud[0]['nombrecampo']]));
   
     /* $sinprimercampo=$query->
       andFilterWhere(['esclave'=>'1'])->asArray()->all();
      if(count($sinprimercampo)==0)       
        throw new \yii\base\Exception(Yii::t('import.errors', 'The import records has not a field key'));
   */
   }
   
   public function hasAttach(){
       return (count($this->files)>0)?true:false;
   }
   
  
   
  public function Childs(){
     
     return $this->childQuery()->orderBy(['orden'=>SORT_ASC])->all();
  }
  public function ChildsAsArray(){
     return   $this->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
  }
  
  
 /*
  * prepara los atributos para almacenarlos en el modelo
  * usa una fila de csv  y los nombres de los campos
  * en la carga
  * @row: Una fila del archivo csv (es una array de valores devuelto por la funcion fgetcsv())
   * @filashijas : array de registros hijos del objeto de carga
  */
 public function AttributesForModel($row,$filashijas){
      //$filashijas=$this->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
     //$modelo=$cargamasiva->modelAsocc();
     $attributes=[];
      foreach($row as $orden=>$valor){          
               $attributes[$filashijas[$orden]['nombrecampo']]=$valor;
           }
     return $attributes;  
 }
 
 public function isTypeChar($tipo){
     return (substr(strtoupper($tipo),0,4)=='CHAR');
 }
 public function isTypeVarChar($tipo){
     return (substr(strtoupper($tipo),0,7)=='VARCHAR');
 }
 public function isNumeric($tipo){
     return ((substr(strtoupper($tipo),0,3)=='INT')or
                  (substr(strtoupper($tipo),0,4)=='DOUB')OR
                  (substr(strtoupper($tipo),0,4)=='DECI')
                  ) ;
 }
public function isDateorTime($tipo,$nombrecampo){
     return (((substr(strtoupper($tipo),0,4)=='CHAR')or
                  (substr(strtoupper($tipo),0,5)=='VARCHAR')
                   )&& (in_array($longitud,[10,18])) && 
                    (in_array($nombrecampo,$this->modelAsocc()->dateTimeFields)));
 }
 
 
 public function camposClave(){
     if(!$this->insercion){
         $this->childQuery()->
                 select('nombrecampo')->
                 where(['esclave'=>'1'])->
                 asArray()->all();
         
     }
 }
 
 
   
   

   
 /*
  * Esta funcion devuelve el registro hijo de 
  * solo registro activo, estre registro es el que 
  * gestionara la carga    */
 public function activeRecordLoad(){
    $registro= ImportCargamasivaUser::childQueryLoads()->where(['activo'=>'1'])->andFilterWhere(['not',['activo'=>ImportCargamasivaUser::STATUS_CARGADO]])->one();
    if(is_null($registro)){
        throw new \yii\base\Exception(Yii::t('import.errors', 'Verifique que exista un registro de carga pendiente, todos están terminados o no existe ninguno abierto'));
    }else{
        return $registro;
    }
 } 
 
public function ordenCampos(){
    $modelo=$this->modelAsocc();
   $intersecion= array_intersect($modelo->safeFields,$modelo->primaryKey());
  // print_r($modelo->safeFields);
   if(count($intersecion)==0){
       return array_flip($modelo->safeFields);
   }elseif(count($intersecion)==count($modelo->primaryKey())){
     $base=array_diff($modelo->safeFields,$modelo->primaryKey());
     return array_flip(array_values(array_merge($modelo->primaryKey(),$base)));
   }else{
      $base=array_diff($modelo->safeFields, array_intersect($modelo->primaryKey(),$modelo->safeFields)); 
      return array_flip(array_values(array_merge(array_intersect($modelo->primaryKey(),$modelo->safeFields),$base)));
   }
}
 
  
 
}
