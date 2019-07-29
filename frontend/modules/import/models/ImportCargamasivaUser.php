<?php

namespace frontend\modules\import\models;
use frontend\modules\import\components\CSVReader as MyCSVReader;
use common\behaviors\FileBehavior;
use Yii;

/**
 * This is the model class for table "{{%import_carga_user}}".
 *
 * @property int $id
 * @property int $cargamasiva_id
 * @property string $fechacarga
 * @property int $user_id
 * @property string $descripcion
 * @property int $current_linea
 * @property int $total_linea
 * @property string $tienecabecera
 * @property string $duracion
 *
 * @property ImportCargamasiva $cargamasiva
 */
class ImportCargamasivaUser extends \common\models\base\modelBase
{
   const EXTENSION_CSV='csv';
    /**
     * {@inheritdoc}
     */
    public $booleanFields=['tienecabecera','activo'];
    public static function tableName()
    {
        return '{{%import_carga_user}}';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cargamasiva_id', 'user_id', 'descripcion'], 'required'],
            [['cargamasiva_id', 'user_id', 'current_linea', 'total_linea'], 'integer'],
            [['fechacarga'], 'string', 'max' => 18],
            [['descripcion', 'duracion'], 'string', 'max' => 40],
            [['tienecabecera'], 'string', 'max' => 1],
            [['cargamasiva_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportCargamasiva::className(), 'targetAttribute' => ['cargamasiva_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('import.labels', 'ID'),
            'cargamasiva_id' => Yii::t('import.labels', 'Cargamasiva ID'),
            'fechacarga' => Yii::t('import.labels', 'Fechacarga'),
            'user_id' => Yii::t('import.labels', 'User ID'),
            'descripcion' => Yii::t('import.labels', 'Descripcion'),
            'current_linea' => Yii::t('import.labels', 'Current Linea'),
            'total_linea' => Yii::t('import.labels', 'Total Linea'),
            'tienecabecera' => Yii::t('import.labels', 'Tienecabecera'),
            'duracion' => Yii::t('import.labels', 'Duracion'),
        ];
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargamasiva()
    {
        return $this->hasOne(ImportCargamasiva::className(), ['id' => 'cargamasiva_id']);
    }

    /**
     * {@inheritdoc}
     * @return ImportCargaUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImportCargamasivaUserQuery(get_called_class());
    }
    
    
    /*
     * Obtiene el array de datos a cargar, lee 
     * el archivo csv de disco 
     * USa la libreria MyCSVrEADER , que no es nada del otro mundo
     * solo para ahora trabajo de leer un formato csv 
     */
    public function dataToImport(){
       $csv= New MyCSVReader( [
                 'filename' => $this->pathFileCsv(),
                 'fgetcsvOptions' => [ 'startFromLine' =>($this->tienecabecera)?1:0,
                                     'delimiter' => h::settings()->
                                            get(
                                             Yii::$app->controller->module->id,
                                             'delimiterCsv'
                                             ),
                                       ] 
                                ]);
      return $csv->readFile();
  } 
    
   /*Retorna la ruta a un archivo csv adjunto (El primero) 
    * Hace uso del  behavior FileBehavior , que es una clase extendida(
    * con la funcion nueva getFilesByExtension() que devuelve
    * archivos adjuntos filtrados por la extension  */
     
      public function pathFileCsv(){
    $registros=$this->getFilesByExtension(static::EXTENSION_CSV);
    if(count($registros)>0){
        return $registros[0]->getPath();
    }else{
        return null;
    } 
       
   }
   
   
   /*
   * Verifica que la estrucutra de las columnas
   * del csv coinciden 'en forma' con los campos especificados hijos 
   * detectando posibles incositencas en el formato 
   * @row: Una fila del archivo csv (es una array de valores devuelto por la funcion fgetcsv())
   * normalmente es la primera fila
   */
 public function verifyFirstRow($row){
      if($this->cargamasiva->countChilds() <> count($row))
       throw new \yii\base\Exception(Yii::t('import.errors', 'The csv file has not the same number columns ({ncolscsv}) than number fields ({ncolsload}) in this load data',['ncolscsv'=>count($row[0]),'ncolsload'=>$this->countChilds()]));
      /*  las Filas hijas*/
      $filashijas=$this->cargamasiva->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
     // $countFieldsInPrimaryKey=count($this->modelAsocc()->primaryKey(true));
      $validacion=true;
      foreach($row as $index=>$valor){
          $tipo=$filashijas[$index]['tipo'];
          $longitud=$filashijas[$index]['sizecampo'];
          $nombrecampo=$filashijas[$index]['nombrecampo'];
          
          /*Detectando inconsistencias*/
          if(($this->cargamasiva->isTypeChar($tipo)&&($longitud <> strlen($valor))) or
           ($this->cargamasiva->isTypeVarChar($tipo) &&($longitud < strlen($valor))) or                
           ($this->cargamasiva->isNumeric($tipo)&& (!is_numeric($valor)) ) or                   
         ( $this->cargamasiva->isDateorTime($tipo,$nombrecampo)&& (
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
 
    /*
   * El active query de los hijos 
   * de los registros hijos de carga
   *  
     */
    private function childQueryLoads(){
        return ImportCargamasivaUser::find()->
       where(['cargamasiva_id' =>$this->id])->orderBy(['cargamasiva_id'=>SORT_DESC]);
    }
    
    
    
}
