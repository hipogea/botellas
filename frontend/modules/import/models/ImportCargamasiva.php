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
    
    /*Numero de erores en el log de carga*/
    public function nerrores(){
        if(count($this->nregistros()) >0 ){
          return  ImportLogCargamasiva::find()->
                andFilterWhere(['level'=>'0','user_id'=>h::userId()])->count();
        }else{
            return 0;
        }
    }
    
    /*Numero de registros en el  log de carga*/
    public function nregistros(){
       // $query=new ImportCargamasivaQuery();
        return  ImportLogCargamasiva::find()->where(['cargamasiva_id' =>$this->id])->count();
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
                         if(in_array($nameField ,array_keys($modeloatratar->primaryKey(true)))){
                             $esclave=true;
                             $orden=array_search($nameField,array_keys($modeloatratar->primaryKey(true)))+1;
                         } else{
                             $esclave=false;
                             $orden=$i+count($modeloatratar->primaryKey(true));
                         } 
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
                         ImportCargamasivadet::firstOrCreateStatic(
                                        [
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
                                $i+=1;
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
    private function childQuery(){
        return ImportCargamasivadet::find()->
       where(['cargamasiva_id' =>$this->id]);
    }
    
    public function countChilds(){
        $this->childQuery()->/*where(['activa'=>'1'])->*/count();
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
   
      $sinprimercampo=$query->
       andFilterWhere(['esclave'=>'1'])->asArray()->all();
      if(count($sinlongitud)==0)       
        throw new \yii\base\Exception(Yii::t('import.errors', 'The import records has not a field key'));
   
   }
   
   public function hasAttach(){
       return (count($this->files)>0)?true:false;
   }
   
   /*Retorna un archivo csv adjunto (El primero) */
   public function pathFileCsv(){
       
    $registros=$this->getFilesByExtension(static::EXTENSION_CSV);
    if(count($registros)>0){
        return $registros[0]->getPath();
    }else{
        return null;
    } 
       
   }
   
  public function dataToImport(){
       $csv= New MyCSVReader(
              [
                 'filename' => $this->pathFileCsv(),
                 'fgetcsvOptions' => [
                                        'startFromLine' =>($this->tienecabecera)?1:0,
                                     'delimiter' => h::settings()->
                                            get(
                                             Yii::$app->controller->module->id,
                                             'delimiterCsv'
                                             ),
                                ] 
              ]);
      return $csv->readFile();
  } 
  
  /*
   * Verifica que la estrucutra de las columnas
   * del csv coinciden en forma con las columnas 
   * especificadas en lso registros hijos,
   * detectando posibles incositencas en el formato 
   * @row: Una fila del archivo csv (es una array de valores devuelto por la funcion fgetcsv())
   * normalmente es la primera fila
   */
 public function verifyFirstRow($row){
      if($this->countChilds() <> count($row))
       throw new \yii\base\Exception(Yii::t('import.errors', 'The csv file has not the same number columns ({ncolscsv}) than number fields ({ncolsload}) in this load data',['ncolscsv'=>count($row[0]),'ncolsload'=>$this->countChilds()]));
      /*  las Filas hijas*/
      $filashijas=$this->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
     // $countFieldsInPrimaryKey=count($this->modelAsocc()->primaryKey(true));
      $validacion=true;
      foreach($row as $index=>$valor){
          $tipo=$filashijas[$index]['tipo'];
          $longitud=$filashijas[$index]['sizecampo'];
          $nombrecampo=$filashijas[$index]['nombrecampo'];
          
          /*Detectando inconsistencias*/
          if(($this->isTypeChar($tipo)&&($longitud <> strlen($valor))) or
           ($this->isTypeVarChar($tipo) &&($longitud < strlen($valor))) or                
           ($this->isNumeric($tipo)&& (!is_numeric($valor)) ) or                   
         ( $this->isDateorTime($tipo,$nombrecampo)&& (
                            (strpos($valor,"-")===false) &&
                            (strpos($valor,"/")===false) &&
                             (strpos($valor,".")===false)
                          ))
          )
            $validacion=false;
          break;
      }
      if(!$validacion)
         throw new \yii\base\Exception(Yii::t('import.errors', 'The csv file has not the same type columns  than type fields in this load data'));
       
      return $validacion;
 }
 /*
  * prepara los atributos para almacenarlos en el modelo
  * usa una fila de csv  y los nombres de los campos
  * en la carga
  * @row: Una fila del archivo csv (es una array de valores devuelto por la funcion fgetcsv())
   * @filashijas : array de registros hijos del objeto de carga
  */
 public function prepareAttributesToModel($row,$filashijas){
      //$filashijas=$this->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
     //$modelo=$cargamasiva->modelAsocc();
     $attributes=[];
      foreach($row as $orden=>$valor){          
               $attributes[$filashijas[$orden]['nombrecampo']]=$valor;
           }
     return $model;  
 }
 
 private function isTypeChar($tipo){
     return (substr(strtoupper($tipo),0,4)=='CHAR');
 }
 private function isTypeVarChar($tipo){
     return (substr(strtoupper($tipo),0,7)=='VARCHAR');
 }
 private function isNumeric($tipo){
     return ((substr(strtoupper($tipo),0,3)=='INT')or
                  (substr(strtoupper($tipo),0,4)=='DOUB')OR
                  (substr(strtoupper($tipo),0,4)=='DECI')
                  ) ;
 }
 private function isDateorTime($tipo,$nombrecampo){
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
 
 private function flushLogCarga(){
     (new Query)
    ->createCommand()
    ->delete(ImportLogcargamasiva::tableName(), ['user_id' => h::userId()])
    ->execute();
    
   }
   
   
 public function logCargaByLine($line){
     $errores=$this->getErrors();
     foreach($errores as $campo=>$detalle){
         foreach($detalle as $cla=>$mensaje){
             $this->insertLogCarga($line, $campo, $mensaje, '0');
         }
     }
 }
   
 public function insertLogCarga($line,$campo,$mensaje,$level){
     //$this->flushLogCarga();
    // 
     $attributes=[
         'cargamasiva_id'=>$this->id,
         'nombrecampo'=> $campo,
         'mensaje'=>$mensaje,
         'level'=>$level,
         'fecha'=>date('Y-m-d H:i:s'),
         'user_id'=>h::userId(),
         'numerolinea'=>$line,
     ];
     	$model=new ImportLogcargamasiva();
        $model->setAttributes($attributes);
        $model->save();
        unset($model);
        
 }
 
 
 
}
