<?php

namespace common\models\base;
use Carbon\Carbon;
use Yii;
use DateTime;
use common\helpers\FileHelper;
use  yii\web\ServerErrorHttpException;
//use common\models\base\modelBaseTrait;
use common\interfaces\documents\baseInterface;
use common\models\Documentos;

class modelBase extends \yii\db\ActiveRecord  implements baseInterface

{
    public $otherModels=[];
    const PREFIX_ADVANCED = '@';
    const PREFIX_BASIC = '/';
    const NAME_FIELD_CENTER='codcen';
    //use modelBaseTrait;
    
    /*tipos de formatos de fechas a asignar a un campo en 
     * la propiedad $dateorTimeFields (mire los comentarios de esta propiedad, vea el ejemplo) 
     */
    const _FDATE='date';
    const _FDATETIME='datetime';
    const _FTIME='time';
    
    
    /* claves para transformar los formatos de fechas  
     **/
    const _FORMATUSER='timeUSER'; //Formato (salida) para humanos, es decir formato para visulizarlos en los formularios y reportes
    const _FORMATBD='timeBD';//formato para guardarlo en la base de datos como porje jemplo  Y-m-d H:i:s'
    
    
    /*Esta propieda des una matriz de asociacion entre un campo
     * y la tablas de valores comboValores 
     * Se usa para extraer valores de esta tabla de la siguietne forma
     * Por ejemplo
      En la tabla Maestrocompo hay un campo tipo de material
     *    [
     *       'codtipo'=>   'maestrocompo.codtipo' 

     *        
     *        ] 
     * Asociara los valores de esta clave (maestrocompo.codtipo 
     * para sacar un combo o lista de valores de la tabla  comboValores
     *   '100' -- FERRETERIA
     *   '200' -- INSUMOS DE PROD 
     *    ..
     */
    public $fakeRelations=[];
    
    private $_routePrefix;
    
    public $prefijo=null;
    //public $withAudith=false;
    public $withAudit=false; /// Flag para establecer si el  registro va a dejar rastro en la auditoria 
    //public $codigodoc;//codigo documento
    //public $_documento=null;//prefijo codigo documento
    public $_linkFields=array(); ///array , almacena los nombres de los camppos relacionados
                          //con otros modelos 
    public $_obRelations=array(); //Almacena las funciones de relacion 
     //en una matriz (atributo $_obRelation) 
    /*
     * Ejemplo de esta propiedad 
     *    'Maestro'=>       [
     *                          [   'campo1_foraneo'=>'campo1_de_actual_modelo,
     *                              'campo2_foraneo'=>'campo2_de_actual_modelo,
     *                            ],
     *                          true   //Si se trata de una relacion HAS_MANY=true, HAS_ONE=False
     *                          'getMaestros',   //El nombre de la funcion que obtiene el obejto activeQuery
     *                      ],
     *     'Trabajadores'=>[
     * 
     *                          ...
     *                      ]
     * 
     * 
     */
    
    
    
    
    public $hardFields=array(); //array de campos DUROS  , es decir campos que    
    //uan vez que se graba el registro y tiene hijos YA NO SE PUEDE MODIFICAR,
    //ASI NO SEA UN CAMPO LINKEADO  
    
   // public $blockedFields=[]; //array de campos que no pueden ser editados 
    //debido a que son campos link 
    
    public $dateorTimeFields=array();
    //especificar en este array cuales son los campos 
    // array('campo1'=>'date',
     //      'campo2'=>'datetime'.
      //      'campo3'=>'time' )
   
    public $booleanFields=[]; // array para almacenar los campos que se consideran booleanos 
    
    public function getLinkFields(){
       if(count($this->_linkFields)==0){
           
                    }
   }
   
   
  public function makeReport(){}
    
   
   
   
   
   
   //solo refresca la propiedad $_obRelations
   //public function obRelations(){
      //if(count($this->_obRelations)==0 || $force ){
          //return $this->fillObRelations();
          //return true;
                   //}
      //return false;           
                   // }
     
   /*
    * Devuelve una matriz con 
    * la sguitente estrucutura :
    *   [
    *      'campo_local_link'=>'NombreclaseForaneaRelacionada',
    *      'campo_local_link1'=>'NombreclaseForaneaRelacionada1',
    * ...
    *    ]
    * @params: onlyChilds: null todos los campos , true solo hasMany, false : SOlo HasOne
    */
  
   public function fieldsLink($onlyChilds=null){
       $campos=[];
       if(count($this->_linkFields)==0){
         
     // if(count($this->_linkFields)==0 || $force ){  
      $matriz=$this->fillRelations();//refresca la propiedad _obRelations
         //var_dump(array_values($this->_obRelations));
      foreach($matriz as $classmodelo=>$info){ //recoore la porpiedad _obRelations
          
          if($onlyChilds===null){
             foreach($info[0] as $key=>$value){               
             $campos[$value]=$classmodelo;
            } 
          }if($onlyChilds){ //Si es true solo hijos 
              if($info[1])
                  foreach($info[0] as $key=>$value){               
                        $campos[$value]=$classmodelo;
                    } 
          }else{//si es false solo padres 
             if(!$info[1])
                  foreach($info[0] as $key=>$value){               
                        $campos[$value]=$classmodelo;
                    }   
          }
            
          }
          
          
          
          
          
          $this->_linkFields=$campos;
       }
       
         return $this->_linkFields ;       
      }
         
   
   
   /*
    * Verifica si un campo es relacionado, con otro modelo
    * Si esta dentro de la propiedad $_linkFields
    */
   public function is_relatedField($namefield){
       $this->fieldsLink();//refresca la propiedad _linkFields
     // var_dump(array_keys($this->_linkFields));
       return in_array(trim($namefield),array_keys($this->_linkFields));
   }
   
   
   
   /*
    * Verifica si un campo es relacionado, con otro modelo y ademas ya existen
    *  registros relacinados en la tabla hija
    * por lo tanto no debe de editarse este campo en el registro 
    * padre. Util para Formularios 
    */
   
   public function isBlockedField($namefield){
       $retorno=false;
       
       //Si este campo esta dentro de la lista de campos duros  y
       //el presente registro ya tiene hijos, NOS SE DIGA MAS; ESTA BLOQUEADO
       if(in_array(trim($namefield),$this->hardFields) &&
           $this->hasChilds()){
           RETURN true;
       }
        
        
//verificando ahora si el campo es un campo link y ademas está con
//registros relacionados hijos  aguas abajo (HAS_MANY)        
       if($this->is_relatedField($namefield)){
           //verificar sus registros hijos
          
           $this->fillRelations();
           foreach($this->_obRelations as $clase=>$arelacion){ //recoore la porpiedad _obRelations
                 if(in_array(trim($namefield),array_values($arelacion))){
                     if(   $arelacion[1]  && ///si se trata de una reLacion HAS_MANY
                             $this->{$arelacion[2]}()->count() >0){ //si hay registro hijos relacionados 
                         $retorno=true;
                         break;
                     }
                 }
               }
       }
       
         
       
      return $retorno;
   }
   
   /*
    * VERIFICA A NIVEL DE REGISTRO si tiene hijos 
    * relacionados 
    */
   
   public function hasChilds(){
       $retorno=false;
       $this->fillRelations();
     // var_dump($this->_obRelations);
       foreach($this->_obRelations as $funcion=>$link){ //recoore la porpiedad _obRelations
                  if($link[1]){ //sis trata de una relacion uno a varios 
                     if($this->{$link[2]}()->count() >0){ //si hay registro hijos relacionados 
                        $retorno=true;                       
                        break; 
                  }
                     
                 }
               }
       return $retorno;
   }
   
   
                            
   
   
   
   
   
   /*
    * Esta funcion actualiza 
    *  el atributo $_obRelations  con las relaciones y sus links
    *   array(  'getOrders' => array('codigo'=>'codart'),
    *           'getAlconversiones' => array('codigo'=>'codart'), 
    *          ...
    *       )
    * De esta forma almacenamos todas las relaciones en una 
    * matriz:
    * Cuando queremos extraer los campos comprometidos en alguna 
    * relacion, bastará con  hace un recorrido a los valores clave 
    */
   public function fillRelations(){
      if(count($this->_obRelations)==0){
          $relaciones=[];
       $calse=new \ReflectionClass(static::class); //LA CLASE HIJA ACTUAL NO LA PADRE 
       $metods=$calse->getMethods();
       UNSET($calse);
       foreach($metods as $key=>$object){
           if (($object->class===static::class))
           if(substr(trim(strtolower($object->name)),0,3)==='get' ){
               /*var_dump(method_exists(static::class,$object->name));
               var_dump(is_object($this->{$object->name}()));
               var_dump(get_parent_class($this->{$object->name}()));
               var_dump(get_class($this->{$object->name}()));
                var_dump($object->name);
                var_dump($this->{$object->name}()->link);*/
           }
               
           if (($object->class===static::class) //es un metodo de la clase actual y no de los parents
               && (substr(trim(strtolower($object->name)),0,3)==='get' ) //comieniza con get
               && (method_exists(static::class,$object->name)) //si es una fucion no una propiedad
               && is_object($this->{$object->name}()) //si devuelve un objeto
               && in_array(get_parent_class($this->{$object->name}()),['yii\db\ActiveQuery','yii\db\Query'])  //si el objeto es una clas actiev Query
                 ){
                               $relaciones[$this->{$object->name}()->modelClass]=[$this->{$object->name}()->link,$this->{$object->name}()->multiple,$object->name]; //carga la propiedad  
                   }
                       // unset($this->{$object->name}());//libera espacio 
                   } 
                   $this->_obRelations=$relaciones;
            }
      
                  // die(); 
               
                return $this->_obRelations;
             }
       
             
  /*
   * Funcion q ue devuelve el nombre de la clase
   * foranea asociada al @campo suministrado 
   * @campo : Nombre de campo suministrado 
   * 
   * Pregunta ¿Porqué hacer esta funcion y no usar 
   * las propiedades getXnamodel() de las funciones de las relaciones
   * hasOne()? 
   * Respuesta: Porque para usar etas funciones se deben de hacer explicitamente
   * en cambio esta funcion solo con el nombre del campo busca 
   * en la propiedad _obRelations la clase modelo que corresponde
   */          
  public function obtenerForeignClass($nombrecampo){
     return $this->fieldsLink(false)[$nombrecampo]; // fieldsLink(false) solo padres HasONE
  }      
   
/*
 * Deveul el campo o un array de campos foraneo
 * segun la relacion 
 */  
 public function obtenerForeignField($nombrecampo){
     $arreglo=$this->fillRelations();
     $nombrecampoforaneo=null;
     $claseforanea=$this->obtenerForeignClass($nombrecampo);
     foreach($arreglo[$claseforanea][0] as $campoforaneo=>$campolocal){
         if($nombrecampo===$campolocal){
             $nombrecampoforaneo=$campoforaneo;
         }
     }
    return $nombrecampoforaneo; 
  }      
    
  public function isSimpleRelation(){
      $retorno=true;
      $arreglo=$this->fillRelations();
      foreach($arreglo as $clave=>$valor){
         if(count($valor)>1){
             $retorno=false;break;
         }
     }
     return $retorno;
  }      
       
        
         
	     
        
        
        
        /*
         * Formatea  una fecha de acuerdo 
         * a la confinguracion general  SETTINGS 
         * configuracion (SETTINGS) donde consulta las variabels
         * que alamcena estos formatos : CATEGORIAS  'timeUSER', 'timeBD'
         * pejm  $this->gsetting('timeUSER' ($key), 'date' ($typ))  retorna una plantilla   'dd/mm/YYYY'
         * @field: nombre del campo a evaluar
         * @key : Valor ('timeUSER' , 'timeBD') para saber com quiere el formato ; para almacenarlo en la BD o mostrarlo al usuario
         * @typ : valores  'date', 'datetime' ó 'time'  dependiendo como sea
         *        el tipo configurado    
         * 
         * formatos permitidos en settings como opciones, cualquier delimitador "/" , "." , "-", "@" 
         *   dd/mm/yyyy yyyy/mm/dd d/mm/yyyy d/m/yyyy yyyy/m/d yyyy/m/dd yyyy/mm/d
         *   Con otro delimitador : 
         *   dd-mm-yyyy
         *   dd.mm.yyyy ...  etc   * 
         */
        private function setFormatTimeFromSettings($field,$key,$typ,$show){
            $formatToShow= $this->gsetting($key, $typ);
             $formatToAnalize= $this->gsetting($this->reverseKey($key), $typ); 
             //yii::error('valor del campo  '.$this->{$field});
             //yii::error('format to analize '.$formatToAnalize);
             //yii::error('format to show '.$formatToShow);
             $objetof=DateTime::createFromFormat($this->getGeneralFormat($formatToAnalize,$typ,$show),$this->{$field});
             //yii::error(' DateTime::creaFrOM(\''.$this->getGeneralFormat($formatToAnalize,$typ,$show).'\',\''.$typ.'\',\''.$this->{$field}.'\' )  ');
             //yii::error('El objecto creado por DateTIME : '. serialize($objetof));
            //yii::error(' FORMATTER->ASDATE(\'OBJETOCREADO\',\''.$this->getGeneralFormat($formatToShow,$typ,$show).'\')  ');
            
                     
              $resultado=Yii::$app->formatter->asDate(
                 DateTime::createFromFormat($this->getGeneralFormat($formatToAnalize,$typ,$show),$this->{$field}),
                        'php:'.$this->getGeneralFormat($formatToShow,$typ,$show));
                  //yii::error(' El resultado : '.$resultado);
             return $resultado;
        }
        
        
        /*
         * Formatea  los campos de fechas o horas
         * segun se quiera mostrr al usuario o 
         * almacenar en labase de datos 
         * para esto se vale de los parametros de 
         * configuracion (SETTINGS) donde consulta las variabels
           que alamcena estos formatos : CATEGORIAS  'timeUSER', 'timeBD'
         * 
         */
        public function prepareTimeFields($show){
            $this->verifyTimeFields();
           $key=($show)?static::_FORMATUSER:static::_FORMATBD;
          // $oldformat=Yii::$app->formatter->dateFormat;
            foreach($this->dateorTimeFields as $field=>$typ){
                //$this->{$field}=$this->setFormatTimeFromSettings($field,$key, $typ);
                $this->{$field}=$this->setFormatTimeFromSettings($field,$key, $typ,$show);
            }
            //Dejamos el objeto como estaba antes 
            //Yii::$app->formatter->dateFormat=$oldformat;
            RETURN TRUE;
        }
        
        private function verifyTimeFields(){
            $allowedValues=[self::_FDATE,self::_FDATETIME,self::_FTIME];
            foreach(array_values($this->dateorTimeFields) as $key=>$value){
                if(!in_array($value,$allowedValues)){
                    throw new ServerErrorHttpException(Yii::t('error', 'Wrong property {valor}  in field time {campo} Times  ',['valor'=>$value,'campo'=>$key]));
    		                   
                }
            }
            return true;
        }
        
        public function afterFind() {
            $this->convertBooleanFields();//COnveritr a booleanos los campos
            $this->prepareTimeFields(true);//Convierte los campos fechas y tiempo en legibles
          return   parent::afterFind();
        }
        
       /* public function beforeSave($insert) {
            $this->prepareTimeFields(false);//Convierte los campos fechas y tiempo almacenables en BD
            parent::beforeSave($insert);
        }*/
            public function beforeSave($insert) {
                $insert=$this->isNewRecord;
         $this->prepareTimeFields(false);//Convierte los campos fechas y tiempo almacenables en BD
       $this->convertBooleanFields(false);
         // $this->setPrimaryKey($this->prefijo);
         return  parent::beforeSave( $insert);
        }
        
        
        
        /*Detecta si el usuario ha modificado un campo 
         * @attribute : El campo a verificar
         * Si no especifica nada, se verificar todo el registro 
         */        
        public function hasChanged($attribute=null){ 
            if( !is_null($attribute)){
               if(in_array($attribute,array_keys($this->dateorTimeFields))){                   
                   return $this->hasChangeTimeField($attribute) ;
                }
                 return (!($this->{$attribute}==$this->getOldAttribute($attribute)));
        
            }else{
                $changed=false;
                foreach($this->attributes as $name->$value){
                    if($this->hasChanged($name)){$changed=true;break;}
                }
                return $changed;
            }
          }
        
        
        
        
        /*
         * Esta funcion , compara un campo 
         * fecha en formatos originales de la BD
         * de tal modo que detecta el VERDADERO cambio del 
         * campo. Sabiendo que existe un cambio falso 
         * que ocasionba la funcion prepareTimeFields()
         * al ejecutarse  cada vez que el modelo presenta
         * estos campos con le evento afterfind();
         */
        private function hasChangeTimeField($attribute){  
            
                    $oldformat=Yii::$app->formatter->dateFormat;
                    Yii::$app->formatter->dateFormat =
                     $this->gsetting(static::_FORMATBD, $this->dateorTimeFields[$attribute]);
                   $currentValue= Yii::$app->formatter->format($this->{$attribute}, $this->dateorTimeFields[$attribute]);
                   $originalValue=$this->getOldAttribute($attribute);
                   Yii::$app->formatter->dateFormat=$oldformat;
                    return (!($currentValue==$originalValue));               
              
        }
        
        private function  getGeneralFormat($format,$type,$show){
            $expresion="/[^a-zA-Z0-9]/";   
            preg_match($expresion,$format,$valores);
            $delimiter=$valores[0]; 
            yii::error('los valores :'. serialize(explode($delimiter,$format)));
            $ygriega='Y';
            $mes='m';
            $dia='d';
            foreach(explode($delimiter,$format) as $clave=>$valor){
                if($valor==='yy' && $show){$ygriega='y';}   
                if($valor==='m' && $show){$mes='n';} 
                if($valor==='d' && $show){$dia='j';}  
            }
            // $format= $this->gsetting($key, $type);
            if(strtolower(substr(trim($format),0,1))=='d'){
                if($type==static::_FDATE)return $dia.$delimiter.$mes.$delimiter.$ygriega;
                if($type==static::_FDATETIME)return $dia.$delimiter.$mes.$delimiter.$ygriega.' H:i:s';
                if($type==static::_FTIME)return 'H:i:s';
            }
            if(strtolower(substr(trim($format),0,1))=='y'){
                if($type==static::_FDATE)return $ygriega.$delimiter.$mes.$delimiter.$dia;
                if($type==static::_FDATETIME)return $ygriega.$delimiter.$mes.$delimiter.$dia.' H:i:s';
                if($type==static::_FTIME)return 'H:i:s';
            }
            
             
           
        }
        
        private function reverseKey($key){
            if($key==static::_FORMATUSER)return static::_FORMATBD;
            if($key==static::_FORMATBD)return static::_FORMATUSER;
              
        }
        
        
        public  static function  firstOrCreateStatic($attributes){  
            //print_r($attributes);
            //$model=self::find()->where($attributes)->one();
            if(is_null(self::find()->where($attributes)->one())){
                try{
                    $clase= static::class;
                    $model=new $clase;
                    //$model->oldAttributes=[];
                       $model->attributes=$attributes;
                      // print_r($model->attributes);
                    $model->insert();unset($model);
                    //echo "ok  ----->";
                        return true;
                } catch (\yii\db\Exception $exception) {
                    echo "    --->  error  :   ".$model->nombre_campo."  ". $exception->getMessage();
                     return false;
             } 
                
            } else{
                return false;
            }
            
        }
        
        public  function  firstOrCreate($attributes){  
            //print_r($attributes);
            if(is_null($this->find()->where($attributes)->one())){
                try{
                       $this->attributes=$attributes;
                    $this->insert();
                    //echo "ok  ----->";
                        return true;
                } catch (\yii\db\Exception $exception) {
                     //echo "error  :". $exception->getMessage();
                     return false;
             } 
                
            } else{
                return false;
            }
            
        }
        
   
    public  function maxValue($field,$campocriterio=null){
        if(is_null($campocriterio))
            return self::instance()->find()->max($field);
            return self::instance()->find()->where([$campocriterio=>$this->{$campocriterio}])->max($field);
    }  
    
    private function getFieldSize($field){
        /*var_dump($this->getDb()->
                schema->getTableSchema($this->tableName())->
                getColumn($field)->size);die();*/
             return   $this->getDb()->
                schema->getTableSchema($this->tableName())->
                getColumn($field)->size;
    }
    
    public function correlativo($field,$longitud=null,$campocriterio=null){
        /*verificando la longitud con el tamaño del campo
         * */
        $tamano=$this->getFieldSize($field);
         //var_dump($longitud);die();
        if(!is_null($longitud))
        if($tamano > $longitud){
           $tamano=$longitud;
        }
       // var_dump($tamano);
        
        /*Si el campo criterio es diferente a null*
         * Se reemplaza por preijo
         */
           if(!is_null($campocriterio))
                $this->prefijo=$this->{$campocriterio};      
         /*
         * Si el prefijo es <> null se sigue achicando el tamano
         */
           if(!is_null($this->prefijo)){
                            $tamano=$tamano-strlen(trim($this->prefijo));
              }else{
                          $this->prefijo="";
             }
                  
                                
        $maximus=self::maxValue($field,$campocriterio);
        if(is_null($maximus) or empty($maximus)){           
            $maximus=1;
             return $this->prefijo.str_pad($maximus,$tamano,'0',STR_PAD_LEFT);
             }else{
           $maximus=$maximus+1; 
           //aqui sin el prefijo porque ya esta calculado
            return str_pad($maximus,$tamano,'0',STR_PAD_LEFT);
        }
        
       
       // var_dump($maximus);
       // var_dump($tamano);die();
       
    }
    
    public function getFirstError($attribute=null) {
        if(is_null($attribute)){
            if($this->hasErrors()){
               foreach($this->getErrors() as $clave=>$valor){
                   $mensaje=$valor[0];break;
               }
               return $clave.":".$mensaje;
            }ELSE{
                RETURN "";
            }
        }ELSE{
          parent::getFirstError($attribute);  
        }
        
    }


    /**
     * Get available and assigned routes
     * @return array
     */
    public function getRoutes()
    {
        //$manager = Configs::authManager();
        // Get advanced configuration
       // var_dump(Configs::instance()->advanced);die();
        $advanced = false;
        if ($advanced) { 
            // Use advanced route scheme.
            // Set advanced route prefix.
            $this->_routePrefix = static::PREFIX_ADVANCED;
            // Create empty routes array.
            $routes = [];
            // Save original app.
            $yiiApp = Yii::$app;
            // Step through each configured application
            foreach ($advanced as $id => $configPaths) {
                // Force correct id string.
                $id = $this->routePrefix . ltrim(trim($id), $this->routePrefix);
                // Create empty config array.
                $config = [];
                // Assemble configuration for current app.
                foreach ($configPaths as $configPath) {
                    // Merge every new configuration with the old config array.
                    $config = yii\helpers\ArrayHelper::merge($config, require (Yii::getAlias($configPath)));
                }
                // Create new app using the config array.
                unset($config['bootstrap']);
                $app = new yii\web\Application($config);
                // Get all the routes of the newly created app.
                $r = $this->getAppRoutes($app);
                // Dump new app
                unset($app);
                // Prepend the app id to all routes.
                foreach ($r as $route) {
                    $routes[$id . $route] = $id . $route;
                }
            }
            // Switch back to original app.
            Yii::$app = $yiiApp;
            unset($yiiApp);
        } else {
            // Use basic route scheme.
            // Set basic route prefix
            $this->_routePrefix = static::PREFIX_BASIC;
            // Get basic app routes.
            $routes = $this->getAppRoutes();
           
        }
        $exists = [];
       // var_dump($manager->getPermissions());die();
       /* foreach (array_keys($manager->getPermissions()) as $name) {
            if ($name[0] !== $this->routePrefix) {
                continue;
            }
            $exists[] = $name;
            unset($routes[$name]);
        }*/
        return [
            'available' => array_keys($routes),
            'assigned' => $exists,
        ];
    }

    /**
     * Get list of application routes
     * @return array
     */
    public function getAppRoutes($module = null)
    {
        if ($module === null) {
            $module = Yii::$app;            
        } elseif (is_string($module)) {
            $module = Yii::$app->getModule($module);
        }
        $key = [__METHOD__, Yii::$app->id, $module->getUniqueId()];
       
       // $cache = Configs::instance()->cache;
        //var_dump(Configs::instance()->cache);die();
        //if ($cache === null || ($result = $cache->get($key)) === false) {
           // $result = [];
            
               //echo get_class($module)."<br>";
              
            $this->getRouteRecursive($module, $result);
            //print_r($result);die();
            /*if ($cache !== null) {
                $cache->set($key, $result, Configs::instance()->cacheDuration, new TagDependency([
                    'tags' => self::CACHE_TAG,
                ]));
            }*/
       // }
      
        return $result;
    }

    /**
     * Get route(s) recursive
     * @param \yii\base\Module $module
     * @param array $result
     */
    protected function getRouteRecursive($module, &$result)
    {
        $token = "Get Route of '" . get_class($module) . "' with id '" . $module->uniqueId . "'";
      // echo $token."<br>";
        Yii::beginProfile($token, __METHOD__);
        try {
           // print_r(array_keys($module->getModules()));echo "<br>";
            foreach ($module->getModules() as $id => $child) {
               if (($child = $module->getModule($id)) !== null) {
                    //echo "modulo hijo ".$child."<br>";
                    $this->getRouteRecursive($child, $result);
                    
                }
               // $child = $module->getModule($id);
               // echo "el id ".$id."<br>";
            }
     //echo "saliendo<br>";
            foreach ($module->controllerMap as $id => $type) {
                
                $this->getControllerActions($type, $id, $module, $result);
            }

            $namespace = trim($module->controllerNamespace, '\\') . '\\';
            //echo get_class($module)." --> ".$namespace."<br>";
            $this->getControllerFiles($module, $namespace, '', $result);
            $all = '/' . ltrim($module->uniqueId . '/*', '/');
            $result[$all] = $all;
           // echo  get_class($module)."<br>";
        } catch (\Exception $exc) {
            Yii::error($exc->getMessage(), __METHOD__);
        }
        Yii::endProfile($token, __METHOD__);
    }

    /**
     * Get list controller under module
     * @param \yii\base\Module $module
     * @param string $namespace
     * @param string $prefix
     * @param mixed $result
     * @return mixed
     */
    protected function getControllerFiles($module, $namespace, $prefix, &$result)
    {
        $path = Yii::getAlias('@' . str_replace('\\', '/', $namespace), false);
        $token = "Get controllers from '$path'";
        Yii::beginProfile($token, __METHOD__);
        try {
            if (!is_dir($path)) {
                return;
            }
            foreach (scandir($path) as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                if (is_dir($path . '/' . $file) && preg_match('%^[a-z0-9_/]+$%i', $file . '/')) {
                    $this->getControllerFiles($module, $namespace . $file . '\\', $prefix . $file . '/', $result);
                } elseif (strcmp(substr($file, -14), 'Controller.php') === 0) {
                    $baseName = substr(basename($file), 0, -14);
                    $name = strtolower(preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $baseName));
                    $id = ltrim(str_replace(' ', '-', $name), '-');
                    $className = $namespace . $baseName . 'Controller';
                    if (strpos($className, '-') === false && class_exists($className) && is_subclass_of($className, 'yii\base\Controller')) {
                        $this->getControllerActions($className, $prefix . $id, $module, $result);
                    }
                }
            }
        } catch (\Exception $exc) {
            Yii::error($exc->getMessage(), __METHOD__);
        }
        Yii::endProfile($token, __METHOD__);
    }


  /* Esta funcion ocnveirte el valor de '1' en true
   * utril para campos que leen en labase d edatos 
   * ='1' en lugar de booleanos 
   */
    private function convertBooleanFields($out=true){//
        if($out){
           foreach ($this->booleanFields as $key=>$nameField){
               //var_dump($this->{$nameField});
            $this->{$nameField}=($this->{$nameField}=='1')?true:false;
            }  
        }else{
            foreach ($this->booleanFields as $key=>$nameField){
               // if(gettype($this->{$nameField}))
                
            $this->{$nameField}=($this->{$nameField})?'1':'0';
            }  
        }
       
    }
    
    /*Devuelve el primer campo Safe
     * de un respectico escenario
     */
    public function firstSafedAttribute(){
        $campo=null;
        foreach($this->attributes() as $name=>$value){
            if($this->isAttributeSafe($name)){
                $campo=$name;
                break;
            }
        }
      return $campo;
    }
   
    /*
     * Obtiene un array de campos que no podrían ser editados 
     * requisitos para ser campo bloqueado:
     * isblockedField()
     */
    public function  blockedFields(){
        $bloqueados=[];
        
         foreach($this->attributes as $name=>$valor){
             //echo "registrando  ".$name."<br>";
            // var_dump($name);
            if($this->isBlockedField($name)){
               // echo "cayo  ".$name."<br>";
               $bloqueados[]=$name; 
            }
             
        }
       return $bloqueados;
    }
    
    
    /*
     * Retorna una regla para todos los campos
     * bloqueados para que no  peudasn editar
     * teniendo registros hijos sensibles
     */
    public function ruleBlockedFields(){
    return [
           // [$this->blockedFields(),'required'],
            [$this->blockedFields(),'validateBlockedField','skipOnError' => false],
            
           ];
       
        
    }
    
    /*Regla de validacion para la funcion ruleBlocked Fields
     * ¿Debe ser private??  pruebalo ...
     */
    public function validateBlockedField($attribute, $params){
            if ($this->hasChanged($attribute) ) {
                $this->addError($attribute,yii::t('base.errors','The field "{namefield}" can\'t be modified, other records depend on it',['namefield'=>$attribute]));
            }
    }
    
   /*.
    * 
    * Obtiene una instancia de Carbon pasando
    * un campo del objeto
     */
    public function toCarbon($attribute){
         if (!in_array($attribute, 
                 $this->dateorTimeFields)){
            throw new ServerErrorHttpException(Yii::t('base.errors', 'Wrong property {valor}  in field time {campo} Times  ',['valor'=>$value,'campo'=>$key])); 
         }
          if($this->dateorTimeFields[$attribute]==static::_FDATE)
              return Carbon::createFromFormat('Y-m-d',$this->getOldAttribute($attribute));
           if($this->dateorTimeFields[$attribute]==static::_FDATETIME)
              return Carbon::createFromFormat('Y-m-d H:i:s',$this->getOldAttribute($attribute));
            if($this->dateorTimeFields[$attribute]==static::_FTIME)
              return Carbon::createFromFormat('H:i:s',$this->getOldAttribute($attribute));
                   
          
           }
  /*
   * Obtiene una coleccion de clases modelos (strings)
   * relacionados ; pero aguas arriba (hasOne) 
   * return  array(nombrescortos=>nombreslargos)
   */        
  public function parentModels(){
     return $this->modelsByRelations(true);
  }
  /*
   * Obtiene una coleccion de clases modelos (strings)
   * relacionados ; pero aguas abajo (hasMany) 
   * return  array(nombrescortos=>nombreslargos)
   */ 
  public function childModels(){
      return $this->modelsByRelations(false); 
  }
  
  private function modelsByRelations($parents=true){
     $arre=$this->fillRelations();
      $modelos=[];
      foreach($arre as $clases=>$valores){
          if($valores[1]){//si son hijos 
              if($parents===false) //si se indinca hijos
                   $modelos[FileHelper::getShortName($clases)]=$clases; 
          }else{//son padres
              if($parents) //si se indnica padres
                  $modelos[FileHelper::getShortName($clases)]=$clases; 
          }         
             
      }
      return $modelos;
  }
     
  
  public function comboValores($field){
      if(!in_array($field, array_keys($this->fakeRelations)))
       return false;  
      
  }
  
}
              
   

