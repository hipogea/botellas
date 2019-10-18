<?php
/*clase para gestionar los documentos fisicos en la aplicaicon
 * fimra, estados, correo, en general 
 */
namespace common\models\base;
//use common\interfaces\DocumentInterface;
use common\models\base\Estado;
use common\models\masters\Documentos;
use common\models\masters\Centros;
use common\models\config\Config;
use common\models\base\modelBase as ModeloGeneral ;
use common\models\masters\Valoresdefault ;
use common\interfaces\documents\documentBaseInterface as docuInterface;
use common\helpers\h;
use Yii;
class DocumentBase extends ModeloGeneral implements docuInterface
{
  public $estados=null; //array de estados del documento
  public $childMessages='';//campo referencial para almacenar los MENSAJES DE ERRORES DE LOS HIJOS
  public $fieldCodocu; //nombre del campo que almacena el documento
 
  public $fieldStatus; //nombre del campo que almacena el estado
  public $fieldCodCenter; //nombre del campo que almacena el centro logistico
  //public $documentCode; //codigo del documento
  public $mapTables=[];//guarda los pares 
  //[ 'modelo'=>'modelotemp','modelo2'=>'modelo2temp'] que van ah estar involucrados en 
  //como hijos 
   
  /*
   * Errores y avisos de los hijos o items 
   * para simular a la propiedad getErrors() de 
   * Activerecord
   * 
   */
  private $_errorsChild=[];
  
 const FIELD_ID='id';
 const FIELD_IDTEMP='idtemp';
 const FIELD_IDSTATUS='idstatus';
 const FIELD_IDUSERTEMP='idusertemp';
  
 
   
 public function init(){
     //if(!$this->hasAttribute($this->nameFieldDocument()))
     //throw new ServerErrorHttpException(Yii::t('models.errors', 'The property \'{documento}\' is empty,  in class \'{clase}\' ',['documento'=>$this->nameFieldDocument(),'clase'=>self::class]));
      //if(!$this->hasAttribute($this->nameFieldStatus()))
     //throw new ServerErrorHttpException(Yii::t('models.errors', 'The property \'{estado}\' is empty,  in class \'{clase}\' ',['estado'=>$this->nameFieldStatus(),'clase'=>self::class]));
     
     /*obteniendo el cpodigo del documento de las tablas de cdocumenrtos*/
   
     
      parent::init();
      //if(empty($this->codocu))
          //throw new \yii\base\Exception(yii::t('base.errors','Property "codocu" is empty'));
     // if(is_null($this->documento))
          //throw new \yii\base\Exception(yii::t('base.errors','Doesn\'t exists any Document for  "codocu={codigo}"  property',['codigo'=>$this->codocu]));
  
}
 
 public function getDocumento()
    {
       if(!$this->isNewRecord)
        return $this->hasMany(Documentos::className(), ['codocu' => 'codocu']);
       return Documentos::find()->where(['codocu'=>$this->codocu])->one();
       }
 
     
   
   
   public function printDocument(){}
    public function viewDocument(){}
    public function gettCentro(){}
    public function gettSociedad(){}
    public function gettEstado(){}
   // public function hasChilds();
    public function getNumber(){}
    
    
    public function gettTitle(){
        return $this->obDocument()->desdocu;
    }
   
    public function gettClase(){}
    public function gettAbreviatura(){
        return $this->obDocument()->abreviatura;
    }
    
    public function gettPrefijo(){
        return $this->obDocument()->prefijo;
    }
     
    public function makeReport() {
        parent::makeReport();
    }
    public function isComprobante(){
        return $this->charToBoolean($this->obDocument()->escomprobante);
    }
    public function gettTipo(){
         return $this->obDocument()->tipo;
    }
    /* validacion de los parametros con los cuales se va 
     * a trabajar 
     */
     
     
     
     
     public function getStatus(){
        return $this->{$fieldStatus};
    }
    
    
   
    
    
    /*Return un array of all status from this document*/
    private function getAllStatus(){
      if(is_null($this->estados))
        $this->estados=Estado::find()->where(['codocu'=>$this->codocu])
    ->asArray()
    ->all();
      return $this->estados;
    }
    
    public function getStatusName(){
       foreach($this->estados as $fila){
           if($this->getStatus()==$fila['codestado']){
               $valor=$fila['estado'];
               break;
           }
       }
       return $valor;
        //ArrayHelper::getColumn($this->getAllStatus(), 'id');
    }
    
    public function setStatus($newStatus){
       if(in_array($newStatus,ArrayHelper::getColumn($this->getAllStatus(), 'codestado'))){
          throw new ServerErrorHttpException(Yii::t('error', 'Don\'t exists the status "{estado} for this document ({documento}) ',['estado'=>$newStatus,'documento'=>$this->documentCode]));
    		  
       }else{
           $this->{$this->fieldStatus}=$newStatus;
       }
    }
    
    
    /*private function getParameters(){     
       return Config::find()->where([
            'codocu'=>$this->documentCode,
    'codcen'=>$this->{$this->fieldCodCenter},
            ])
    ->asArray()
    ->all();      
    }*/
    
    public function config($code){ 
        return static::getConfig(
                $code,
                $this->{$this->codigodoc},
               $this->{$this->fieldCodCenter}
                );    }
    
                
    
    public static function getConfig($code,$codocu,$codcen){
        $query=Config::find()->where([
            'codocu'=>$codocu,
            'codcen'=>$codcen,
            'codparam'=>$code,
            ]);
       if(!$query->exists()){
          throw new ServerErrorHttpException(Yii::t('error', 'Don\'t exists the code config "{codigo} for  document ({documento}) and center ({centro})  ',['documento'=>$this->{$this->codigodoc},'centro'=>$this->{$this->fieldCodCenter}]));
    		  
       }else{
          return $query->one()->valor;
       }   
    }
    
    
    /*  Obiene el numero de item  segun el nuero de registros hijos activo
     * @var size:  longitud de la cadena
     *    
     *   */
    public function resolveItem($className,$size){ 
         $this->obRelations();
          $foreignFields=array_keys($this->_obRelations[$className][0]);
          $thisFields=array_values($this->_obRelations[$className][0]);
          $numberChilds= $className::find()->where([$foreignFields[0]=>$this->{$thisFields[0]}])->count();
         
       return str_pad(($numberChilds+1).'', $size, '0',STR_PAD_LEFT);
    }
    
    
    
   /* public function parseValues($childClass,$classToStore){
        $fields=array_intersect(array_keys(get_object_vars ($classToStore)),
                array_keys(get_object_vars ($childClass)));
        foreach($fields as $field){
            $classToStore->{$field}=$childClass->{$field};
        }
    }*/
    

/*
     * Guarda  todos los registros hijos de todas las clases hijas 
     * 
       */    
    public function saveChilds(){
        $transaction=$this->getDb()->beginTransaction();
       foreach($this->mapTables as $classStore=>$classTemp){           
             if(!$this->storeValuesChilds($classTemp, $classStore)){
                $transaction->rollBack(); 
             }
          }
        $transaction->commit();          
    }
    
    
    /*Verifia que todos los registros hijos y el padre no tengan errreos*/
    private function allIsOk($storeErrors=true){
        $allOk=true;
        foreach($this->mapTables as $classStore=>$classTemp){           
             $registros=$this->loadChilds($classTemp);
            if(!$this::validateMultiple($registros)){
                $allOk=false;
                if($storeErrors)$this->colectErrorsFromChilds($registros);
                break;                
            }
          }
         unset($registros);
        return ($this->validate() && $allOk);
                
    }
    
    
    private function colectErrorsFromChilds($registros){
        //$allOk=true;
        foreach($registros as $clave=>$row){ 
            if($row->hasErrors()){
                foreach($row->getErrorSummary(true) as $clave=>$message){
                         $this->addError('childMessages',yii::t('error',' The child with id {identidad} has error ',['identidad'=>$row->{static::FIELD_ID}]).$message); 
                      }
            }
           }
         unset($registros);
         return true;        
    }
    
    
    
    
    /*
     * Guarda el registro padre y todos los registros hijos de todas las clases hijas 
     * @test: Para simular la grabacion y anticipar errores , true para graba directamente 
       */
    public function saveAll($test=false){
        if($this->allIsOk() && !$test){
        $transaction=$this->getDb()->beginTransaction();
         if($this->save() && $this->saveChilds()){
            $transaction->commit(); 
            return true;
         }else{
            $transaction->rollBack(); 
            return false;
         }
        }else{
          return false;  
        }           
    }
   
    /*
     * Guarda los registros hijos de una clase hija copiando los valores 
     * de los atributos de la clase $nameClassChilds.
     * Si una de las grabaciones falla, registra y almacena el error en 
     * el campo childMessages, creado para este propósito , luego rompe el bucle
     * 
       */
    public function storeValuesChilds($nameClassChilds,$nameClassToStore){       
       $registros=$this->loadChilds($nameClassChilds);
        if(count($registros)>0 ){
         $fallo=false;             
             // $transaction=$registros[0]->beginTransaction();
              foreach($registros as $child){
                  if($child->id >0){
                      $classToStore=$nameclassToStore::find()
                        ->where(['id' => $child->id])
                        ->one();                       
                  }else{
                     $classToStore=new $nameclassToStore; 
                  }                  
                  $classToStore->attributes=$child->attributes;
                  if(!$classToStore->save()){
                      //$transaction->rollback();
                      foreach($classToStore->getErrorSummary(true) as $clave=>$message){
                         $this->addError('childMessages',yii::t('error',' The child with id {identidad} has error ',['identidad'=>$classToStore->{static::FIELD_ID}]).$message); 
                      }
                      
                      $fallo=true;
                      break;
                      //unset($classToStore);
                  }
                  unset($classToStore);
               } unset($registros);
            if(!$fallo){
                //$transaction->commit();
                return true;
            }else{
               return  false;
            }            
        } else{
         return false; 
            }
      }

      /*
       * Verifica que si hay diferencias entre registros hijos de
       * todas las clases hijas, para esto recorre la matriz de la propiedad
       * mapTables
       */
      public function hasChangedChilds(){
          $haschanged=false;
          foreach($this->mapTables as $classStore=>$classTemp){
              if($this->hasDifference($classStore,$classTemp)){$haschanged=true;}
          }
          return $haschanged;
      }
      
       /*
       * Verifica que si hay diferencias entre registros hijos de
       * una clase  y otra ; Invoca a las funciones loadChildsArray
       * y isSame
       */
      private function hasDifference($classStore,$classTemp){          
         $recordsTemp=$this->loadChildsAsArray($classTemp);
          $recordsStore=$this->loadChildsAsArray($classStore);
          $hasChanged=false;
          foreach($recordsTemp as $key=>$rowtemp){
             if(!$this->isSame($rowtemp,$recordsStore[$key])){
                 $hasChanged=!$hasChanged;
                 break;
             }                 
          }
          return $hasChanged;
      }
      
     
      /*
       * Verifica que una fila tenga los mismos valores de atributos 
       * que otra fila, excepto por alguno campos        * 
       */
      private function isSame($rowtemp,$rowStore){
          $same=true;
          $excepFields=[static::FIELD_ID,static::FIELD_IDSTATUS,self::FIELD_IDTEMP,self::FIELD_IDUSERTEMP];
          foreach($rowtemp as $nombrecampo=>$valor){
              if(!in_array($nombrecampo, $excepFields)){
                  if(!$valor==$rowStore->{$nombrecampo}){
                      $same=!$same; break;
                  }
              }
          }
          return $same;
      }
      
      
      
      /*
     * Esta funcion devuelve un array con los datos de los 
     * registros hijos dada una determinada clase ordenados por el campo ID, esto es util para 
     * ahorrar recursos de memoria en lugar de abrir objetos Active Record
     * Busca los campos link  $foreignFields y $thisFields para establecer el 
     * las condiciones de la clausula Where 
     * @var className : Nombre de la clase , puede ser string u objeto
     * @Return: mixed; set de ActiveRecords, invocando al metodo  $this->relacion     * 
     */
      
      
      private function loadChildsAsArray($className){
          $this->obRelations();
          $foreignFields=array_keys($this->_obRelations[$className][0]);
          $thisFields=array_values($this->_obRelations[$className][0]);
          return $className::find()->where([$foreignFields[0]=>$this->{$thisFields[0]}])->orderBy(static::FIELD_ID.' asc')->asArray();
         
      }
      
      
    /*
     * Esta funcion devuelve el grupo de registros hijos 
     * dada una determinada clase
     * @var className : Nombre de la clase , puede ser string u objeto
     * @Return: mixed; set de ActiveRecords, invocando al metodo  $this->relacion     * 
     */
      
      public function loadChilds($className){
         if(!gettype($className)=='string'){
             $className= get_class($className);
         }
         $this->obRelations();//carga la matriz de relaciones 
         // Si existe esta clase y ademas es multiple HAS_MANY 
         if(in_array($className,array_keys($this->_obRelations) && $this->_obRelations[$className][1] )){
            //convirtiendo  "getXyz" a  "xyz" para invocar a esta funcion directamente $this->xyz
             $nameFunction= strtolower(substr(trim($this->_obRelations[$className][2]),3,1)).substr(trim($this->_obRelations[$className][2]),4);
             return $this->{$nameFunction};
         }else{
            throw new ServerErrorHttpException(Yii::t('error', 'Don\'t exists the model "{model}" in the array relations or it\'s Parent for this model  ',['model'=>$className]));
    	      }
      }
      
     public function hasChangedDocument(){
         return $this->hasChanged() or $this->hasChangedChilds();
     } 
     
     
      /*CUando se omite el centro*/
    public function resolveCentros(){
        if(empty($this->{$this->fieldCodCenter})){
            $this->{$this->fieldCodCenter}= Centros::find()->where(true)->one()->codcen;
           // Centros::find()->where(true)->one()->codcen;
        }
    }
    
   
  private function existsDocuMaster(){
   $registro= Documentos::find()->where(['tabla'=>'\\'.static::class])->one();
   
     if(is_null($registro)){
         throw new \yii\base\Exception(Yii::t('base.errors', 'This Document is not registered. Please register in   \'Documents\' Table With class: \'{clase}\' ' ,['clase'=>static::class]));
     }else{
         $cod=$registro->codocu; unset($registro);
        return $cod;
     }
  }
    
   public function beforesave($insert){
      If($insert) {
          //$this->resolveCodocu();
               
      }
       return parent::beforeSave($insert);
       
   } 
   
  public function resolveCodocu(){
      //VAR_DUMP($this->fieldCodocu);DIE();
      if(empty($this->codocu)){
          $this->codocu=$this->existsDocuMaster();
          if(is_null($this->prefijo))
          $this->prefijo=$this->codocu;
         //$this->{$this->fieldCodocu}=($coddocu)?$coddocu:$this->{$this->fieldCodocu};
           }
   }
   
   public function valuesDefault(){
       $defarr= Valoresdefault::atributesForDefault($this->codocu);
      // var_dump($defarr);die();
       foreach($defarr as $nombre=>$valor){
           $this->{$nombre}=$valor;
       }
   }
   
   public static function gsettingConfig($llave,$valorsino){
       //var_dump(static::keySetting());die();
       return h::gsetting(static::keySetting(), $llave, $valorsino);
   }
   
   private static function keySetting(){
      return h::app()->controller->module->id.'.'.self::getShortNameClass();
       
   }
}
   
