<?php

namespace frontend\modules\import\models;
use frontend\modules\import\models\ImportCargamasiva;

use frontend\modules\import\components\CSVReader as MyCSVReader;
use common\behaviors\FileBehavior;
use common\helpers\timeHelper;
use common\helpers\h;
use Yii;
use yii\db\Query;

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
    const STATUS_ABIERTO='10';
    const STATUS_PROBADO='20';
    const STATUS_CARGADO_INCOMPLETO='30';
    const STATUS_CARGADO='40';
     const STATUS_PROBADO_ERRORES='60';
    
    
    
    const STATUS_COMPLETO='50';
    const SCENARIO_STATUS='status';
    const SCENARIO_MINIMO='minimo';
    const SCENARIO_RUNNING='running_load';
   public $_csv=null;  //OBJETO CSVREADER
   public $hasFile=false;
    /**
     * {@inheritdoc}
     */
    public $booleanFields=['tienecabecera'];
    public $dateorTimeFields=['fechacarga'=>self::_FDATETIME];
    //=['fecingreso'=>self::_FDATE,'cumple'=>self::_FDATE];
    public function init(){
        //$this->current_linea=0;
        $this->total_linea=0;
    }
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
            [['cargamasiva_id', 'descripcion'], 'required'],
            [['user_id'], 'safe'],
            [['cargamasiva_id', 'user_id', 'current_linea', 'total_linea'], 'integer'],
            [['fechacarga'], 'string', 'max' => 19],
            [['descripcion', 'duracion'], 'string', 'max' => 40],
           // [['tienecabecera'], 'string', 'max' => 1],
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
            'fechacarga' => Yii::t('import.labels', 'Fecha'),
            'user_id' => Yii::t('import.labels', 'Iduser'),
            'descripcion' => Yii::t('import.labels', 'Descripción'),
            'current_linea' => Yii::t('import.labels', 'Linea'),
            'total_linea' => Yii::t('import.labels', 'Total Linea'),
            'tienecabecera' => Yii::t('import.labels', 'Cabecera'),
            'duracion' => Yii::t('import.labels', 'Duración'),
             'hasFile' => Yii::t('import.labels', 'Adjunto'),
        ];
    }

     public function scenarios()
    {
        $scenarios = parent::scenarios(); 
        $scenarios[self::SCENARIO_MINIMO] = ['user_id','cargamasiva_id','descripcion','tienecabecera','current_linea_test','activo'];
        $scenarios[self::SCENARIO_STATUS] = ['activo'];
        $scenarios[self::SCENARIO_RUNNING] = ['user_id','activo','current_linea','total_linea','current_linea_test','fechacarga'];
 $scenarios['fechita'] = ['fechacarga'];
        return $scenarios;
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
    
    public function getCsv(){
     //var_dump($this->firstLineTobegin());die();
      if(is_null($this->_csv)){
         
          $this->_csv= New MyCSVReader( [
                 'filename' => $this->pathFileCsv(),
              'startFromLine' =>$this->firstLineTobegin(),
                 'fgetcsvOptions' => [ 
                                     'delimiter' => h::settings()->
                                            get(
                                             Yii::$app->controller->module->id,
                                             'delimiterCsv'
                                             ),
                                       ] 
                                ]);
          return $this->_csv;
      }else{
       return $this->_csv;   
      }
    }
    
    public function firstLineTobegin(){
        if($this->current_linea==0 && $this->tienecabecera)
            return 2;
         if($this->current_linea==0 && !$this->tienecabecera)
            return 1;
         return $this->current_linea + 1 ;
        
    }
    
    /*
     * Obtiene el array de datos a cargar, lee 
     * el archivo csv de disco 
     * USa la libreria MyCSVrEADER , que no es nada del otro mundo
     * solo para ahora trabajo de leer un formato csv 
     */
    public function dataToImport(){
      yii::error('comenzando a leer el csv',__METHOD__);
      $datos= $this->csv->readFile();
      $this->total_linea=count($datos);
      return $datos;
  } 
    
   /*Retorna la ruta a un archivo csv adjunto (El primero) 
    * Hace uso del  behavior FileBehavior , que es una clase extendida(
    * con la funcion nueva getFilesByExtension() que devuelve
    * archivos adjuntos filtrados por la extension  */
     
      public function pathFileCsv(){
    $registros=$this->getFilesByExtension(ImportCargamasiva::EXTENSION_CSV);
    
    if(count($registros)>0){
        return $registros[0]->getPath();
    }else{
         throw new \yii\base\Exception(Yii::t('import.errors', 'No hay ningún archivo csv adjunto'));
     
    } 
       
   }
   
   
   /*
   * Verifica que la estrucutra de las columnas
   * del csv coinciden 'en forma' con los campos especificados hijos 
   * detectando posibles incositencas en el formato 
   * @row: Una fila del archivo csv (es una array de valores devuelto por la funcion fgetcsv())
   * normalmente es la primera fila
   */
 public function verifyFirstRow(){
     $row=$this->csv->getFirstRow();
     $carga=$this->cargamasiva;
      if($carga->countChilds() <> count($row)){
         //throw new \yii\base\Exception(Yii::t('import.errors', 'The csv file has not the same number columns ({ncolscsv}) than number fields ({ncolsload}) in this load data',['ncolscsv'=>count($row),'ncolsload'=>$this->cargamasiva->countChilds()]));
       $this->addError('activo',Yii::t('import.errors', 'El archivo  csv de carga adjunto, tiene ({ncolscsv}) columnas y la plantilla de carga tiene  ({ncolsload}) columnas; no coinciden, revise el archivo adjunto',['ncolscsv'=>count($row),'ncolsload'=>$this->cargamasiva->countChilds()]));
      return false;       
      }
       /*  las Filas hijas*/
      $filashijas=$carga->ChildsAsArray();
     // $countFieldsInPrimaryKey=count($this->modelAsocc()->primaryKey(true));
      $validacion=true;
     // var_dump($filashijas,$row);die();
      foreach($row as $index=>$valor){
          $tipo=$filashijas[$index]['tipo'];
          $longitud=$filashijas[$index]['sizecampo'];
          $nombrecampo=$filashijas[$index]['nombrecampo'];
         
          /*Detectando inconsistencias*/
          if(($carga->isTypeChar($tipo)&&($longitud <> strlen($valor))) or
           ($carga->isTypeVarChar($tipo) &&($longitud < strlen($valor))) or                
           ($carga->isNumeric($tipo)&& (!is_numeric($valor)) ) or                   
         ( $carga->isDateorTime($tipo,$nombrecampo)&& (
                            (strpos($valor,"-")===false) &&
                            (strpos($valor,"/")===false) &&
                             (strpos($valor,".")===false)
                          ))
          )
            $validacion=false;
          break;
      }
      if(!$validacion){
          $this->addError('activo',Yii::t('import.errors', 'Error en el formato de la columna  "{columna}", los tipos no coinciden, revise el archivop de carga',['columna'=>$nombrecampo]));
        // throw new \yii\base\Exception(Yii::t('import.errors', 'The csv file has not the same type columns "{columna}" than type fields in this load data',['columna'=>$nombrecampo]));
           return false; 
              }
         
      return $validacion;
 }
 
 public function flushLogCarga(){
     (new Query)
    ->createCommand()
    ->delete(ImportLogcargamasiva::tableName(), ['user_id' => h::userId()])
    ->execute();
    
   }
 
    public function logCargaByLine($line,$errores){
         yii::error($errores); 
    // $errores=$this->getErrors();
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
        //$model->rawDateUser('fecha');
        $model->setAttributes($attributes);
        $retorno= $model->save();
        //if(!$retorno){print_r($model->getErrors());die();}
        //unset($model);
        
 }
 
  /*Numero de erores en el log de carga*/
    public function nerrores(){
        if($this->nregistros() >0 ){
          return  ImportLogCargamasiva::find()->
                andFilterWhere(['level'=>'0','user_id'=>h::userId()])->count();
        }else{
            return 0;
        }
    }
   /*Numero de registros en el  log de carga*/
    public function nregistros(){
       // $query=new ImportCargamasivaQuery();
        return  ImportLogcargamasiva::find()->where(['cargamasiva_id' =>$this->id])->count();
    }
 
    /*
   * El active query de los hijos 
   * de los registros hijos de carga
   *  
     */
    public function childQueryLoads($idcarga=null){
        if(is_null($idcarga))
        return static::find()->
       where(['cargamasiva_id' =>$this->id])->orderBy(['cargamasiva_id'=>SORT_DESC]);
    }
    
    public function isComplete(){
        return ($this->current_linea >= $this->total_linea);
    }
   
    
    public function afterSave($insert, $changedAttributes) {
        if(!$insert && $this->activo==self::STATUS_CARGADO )
        $this->deleteFile($this->id); //BORRAR EL ARCHIVO DE CARGA ADJUNTO
        return parent::afterSave($insert, $changedAttributes);
    }
    
    
    
   
    /*Retorna si tiene el csv adjunto (El primero) 
    * Hace uso del  behavior FileBehavior , que es una clase extendida(
    * con la funcion nueva getFilesByExtension() que devuelve
    * archivos adjuntos filtrados por la extension  */
     
      public function hasFileCsv(){
    $registros=$this->getFilesByExtension(ImportCargamasiva::EXTENSION_CSV);
      $tiene= (count($registros)>0)?true:false; 
       if(!$tiene){
           $this->addError('activo',yii::t('import.errors','Este registro no tiene adjuntado ningun archivo '.ImportCargamasiva::EXTENSION_CSV));
           return false;   
       }
       return true;
   }   
   
   /*Si se esta efectando la carga y no ha habido errores
    * en la prueba 
    */
   private function NotHasErrorsInLogAndIsCarga($verdadero){
       //Solo es imposible si hay errores en el log  y ademas es una carga 
      $imposible= ($this->nerrores()>0 and $verdadero)?true:false;
      if($imposible)$this->addError ('activo',yii::t('import.errors','Se han detectado errores en el registro al momento de probar, corrija los errores, puede visulizarlos en el log'));
     return !$imposible;
      
   }
   
   
   /*
    * Funcion para importar regsitros
    * verdadero: False solo prueba y detecta errores  , true Simulacion
    * 
    */
     public function importar($verdadero=false){
          $timeBegin=microtime(true);     
        $interrumpido=false;     
        // $this->flushLogCarga();
        $cargamasiva=$this->cargamasiva; 
        $cargamasiva->verifyChilds();//Verificando las filas hijas de metadatos
       $camino=$this->pathFileCsv();
      $linea=0;
       //$this->verifyFirstRow(); //Verifica la primera fila valida del archivo csv, esto quiere decir que no neesarimente sera la primer linea 
           yii::error('Ahora verficando la validez',__METHOD__);     
        if($this->isReadyToLoad($verdadero) &&
            $this->hasFileCsv() && $this->verifyFirstRow()   &&
            $this->canLoadForStatus($verdadero) &&
             $this->NotHasErrorsInLogAndIsCarga($verdadero)
                ){
            //yii::error('Ya paso ..., inciando el proceso',__METHOD__);  
            // VAR_DUMP($carga->pathFileCsv());die();
                      $this->flushLogCarga();//Borra cualquier huella anterior en el log de carga
                       yii::error('Ya paso ..., Leyendo datos ',__METHOD__);  
                      $datos=$this->dataToImport(); //todo el array de datos para procesar, siempre empezara desde current_linea para adelante 
                      
                      yii::error('Ya leyo  los datos estanb listos ',__METHOD__);  
                      $filashijas=$cargamasiva->ChildsAsArray();
                    $linea=($cargamasiva->tienecabecera)?0:1;//si tiene cabecera comienza de 1 
                    $oldScenario=$this->getScenario();
                    $this->setScenario(self::SCENARIO_RUNNING);
                    yii::error('Iniciando Bucle For  Linea => '.$linea,__METHOD__);  
                      
                foreach ($datos as $fila){  
                     //Devuelve el modelo asociado a la importacion
                     //dependiendo si es insercion o actualizacion usa una u otra funcion
                    yii::error('Esta es la linea => '.$linea,__METHOD__);  
                    
                   // yii::error($fila,__METHOD__);  
                    $model=($cargamasiva->insercion)?$cargamasiva->modelAsocc():$cargamasiva->findModelAsocc($fila);
                     yii::error('Colocando atributos => '.$linea,__METHOD__); 
                     $model->setAttributes($cargamasiva->AttributesForModel($fila,$filashijas));
                        if($verdadero){
                            try{
                                 yii::error('Grabando registro  => '.$linea,__METHOD__); 
                    
                              if($model->save()){
                                 yii::error('Grab0  bien bien   => '.$linea,__METHOD__); 
                     
                              }  else{
                                   yii::error('no grabo    => '.$linea,__METHOD__); 
                     
                              }
                            } catch (\yii\db\Exception $ex) {
                                 $model->addError($model->safeAttributes()[0],
                                       $ex->getMessage());
                                 yii::error('caray .. error => '.$linea,__METHOD__); 
                    
                               
                            }
                            
                            
                            
                            }  else{
                            $model->validate(); 
                            } 
                                        if($model->hasErrors()){
                                             yii::error('Tiene errores, aegar log  => '.$linea,__METHOD__); 
                                            // var_dump($model->getErrors()); die(); 
                                            $this->logCargaByLine($linea,$model->getErrors());
                                            }
                                        unset($model);
                                 /*Solo si es carga actualizar la linea actual*/
                               if($verdadero){
                                $this->setAttributes([
                                    'current_linea'=>$linea,
                                    ]);
                                   
                               }else{
                                   $this->setAttributes([
                                    'current_linea_test'=>$linea,
                                    ]);
                               }
                                $this->save();  
                $deltaTime=microtime(true)-$timeBegin;
                            if(timeHelper::excedioDuracion($deltaTime,20) )
                                {
                                     yii::error('Opps se interrumpio  => '.$linea,__METHOD__);      
                                $interrumpido=!$interrumpido;
                                            break; 
                                      }
                            $linea++; 
                         }//fin del for 
                            
                    $this->setScenario(static::SCENARIO_RUNNING);
                    $this->rawDateUser('fechacarga'); //asigan la fecha actual 
                                    $this->setAttributes([
                                        'current_linea'=>($verdadero)?$linea:0,
                                         'activo'=>static::statusForInterruption($interrumpido, $verdadero),
                                           // 'fechacarga'=>$this->rawToUser('fechacarga'), //asigna la fecha hora actual 
                                                ]);
                                            $this->save(); 
                                $this->setScenario($oldScenario);
              
        }else{//Si no esta listo para procesar entonces 
            //var_dump($verdadero, $this->canLoadForStatus($verdadero),"no pasa nad a",$this->getErrors());
            /* var_dump($this->isReadyToLoad($verdadero),
                        $this->hasFileCsv(),
                        $this->verifyFirstRow(),
                        $this->canLoadForStatus($verdadero),
                        //$this->getErrors(),
                        $this->NotHasErrorsInLogAndIsCarga($verdadero),
                        $this->getErrors()
                        ) ;
                    die();*/
            $interrumpido=false;
           
        }     
     ///$this->addError('activo',$camino);
   return $linea;
    }
    
    /*
     * FUNCION QUE COLOCA EL STATUS SEGUN EL CUADRO DE VERDAD SIGUIENTE
     * 
     *  ----------------------------------------------------------
     * |         \   INTERRUMPIDO  |                |
     * |          \                |                |
     *   VERDADERO \               |     SI         |    NO
     * |            \              |                |
     * |-----------------------------------------------------------
     * |                           |                |
     * |          NO               |ESTADO_ABIERTO  | ESTADO_PROBADO
     * |                           |  LINEA INICIO  |  LINEA FINAL
     * |---------------------------|----------------|---------------
     * |                           |                |
     * |            SI             | ESTADO PROBADO | ESTADO CARGADO
     * |                           |  INCOMPLETO    |    LINEA FINAL
     * |                           |  LINEA DONDEQUEDO | 
     *  -------------------------------------------------------------
     */ 
    
   PRIVATE static FUNCTION statusForInterruption($interrumpido,$verdadero){
      if($interrumpido && !$verdadero)//primer cuadrito
       return self::STATUS_ABIERTO;
      if(!$interrumpido && !$verdadero)//segundo cuadrito
       return self::STATUS_PROBADO;
       if($interrumpido && $verdadero)//tercer cuadrito
       return self::STATUS_CARGADO_INCOMPLETO;
        if(!$interrumpido && $verdadero)//cuartor cuadrito
       return self::STATUS_CARGADO;      
   }
           
   /*
     *FUNCION QUE DETERMINA EL BOLLEANO SEGUN LA TABLA DE VERDAD
    * para ejecutar una carga o una prueba 
    * 
    * ---------------------------------------------------------------------------
    *                       ABIERTO     PROBADO     CARGADO_INCOMPLETO      CARGADO
    * ---------------------------------------------------------------------------
    *       PRUEBA           OK           IMPOSIBLE      IMPOSIBLE         IMPOSIBLE
    * --------------------------------------------------------------------------
    *       CARGA            IMPOSIBLE       OK               OK     IMPOSIBLE
    * ----------------------------------------------------------------------------
    * @verdadero:  TRUE se trata de una carga, false : se trata de una prueba 
    * 
    * 
     */
   private function canLoadForStatus($verdadero){
       $estado=$this->activo;  
        if(!$verdadero && ($estado==self::STATUS_PROBADO)){
          $this->addError('activo',yii::t('import.errors','Este registro ya está probado, revise el log de prueba'));
          return false;  
        }
         if(!$verdadero && ($estado==self::STATUS_CARGADO_INCOMPLETO)){
           $this->addError('activo',yii::t('import.errors','Este registro tiene carga incompleta'));
          return false;  
         }
          if(!$verdadero && ($estado==self::STATUS_CARGADO)){
              $this->addError('activo',yii::t('import.errors','Este registro ya está cargado'));
            return false;
          }
          if($verdadero && ($estado==self::STATUS_ABIERTO)){
               $this->addError('activo',yii::t('import.errors','Este registro no puede cargarse, aun no se ha probado, y no debe tener errores'));
           return false;
          }
         if($verdadero && ($estado==self::STATUS_CARGADO)){
            $this->addError('activo',yii::t('import.errors','Este registro ya está cargado'));
            return false;
         }
         return true;
    }    
   
   
     private function isReadyToLoad($verdadero){        
         $estado=$this->activo;
         $isReady=(
            (!$verdadero && ($estado==self::STATUS_ABIERTO)) or 
            ($verdadero && ($estado==self::STATUS_PROBADO)) or 
            ($verdadero && ($estado==self::STATUS_CARGADO_INCOMPLETO))             
           )?true:false;
         if(!$isReady)$this->addError ('activo',yii::t('import.errors','El estado del registro no permite efectuar la operacion'));
         return $isReady;
    } 

public static function lastRecordCreated(){
    return static::find()->
            where(['user_id'=>h::userId()])->
            orderBy(['id' => SORT_DESC])->one();
}
    
}
