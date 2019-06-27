<?php

namespace console\config;
use common\traits\baseTrait;
use yii;
trait SchemaTrait
{
    use baseTrait;
    abstract protected function getDb();
     abstract protected function dropForeignKey($name,$table);
  static $section_settings='tables';
  static $name_field_status_settings='nameFieldStatus';
     static $name_field_codocu_settings='nameFieldDocument';
     static $name_field_center_settings='nameFieldCenter';
  static $collate_charset='utf8_unicode_ci';
  static $db_engine='InnoDB';
   static $db_character_set='utf8';
   
    //definiendo los campos sensibles 
    
    public $dinamycFields;
    public $settings;
    public function init(){
        $this->dinamycFields=[
            'center'=>['nameInSettings'=>'sizeCenters','defaultValue'=>5],
            'dni'=>['nameInSettings'=>'sizeDnis','defaultValue'=>10],
            'ruc'=>['nameInSettings'=>'sizeRucs','defaultValue'=>12],
            'codigoitem'=>['nameInSettings'=>'sizeItemCodes','defaultValue'=>10],
            'regimentributario'=>['nameInSettings'=>'sizeRegimenTributario','defaultValue'=>2],
        ];
      //$this->settings=yii::$app->settings; 
      
        return parent::init();
    }
    
    
    
    public function specialSizeFor($columnName){ 
        if(!in_array($columnName,array_keys($this->dinamycFields)))
         throw new \yii\base\Exception(yii::t('base.errors',' The field \'{field}\' is not registered in Dynamic Fields for \'{clase}\'    ',['field'=>$columnName,'clase'=>static::class]));      
        return $this->sizeOfField($columnName);
        
    }
    
    public function getCollate(){ 
        if($this->hasValidParameterSetting(self::$section_settings,'collateDb',false)){
            return $this->gsetting(self::$section_settings,'collateDb');
        }else{
            return self::$collate_charset;
        }
       
    }
    
    public function getCharacterSet(){ 
      
      if($this->hasValidParameterSetting(self::$section_settings,'characterSet',false)){
            return $this->gsetting(self::$section_settings,'characterSet');
        }else{
            return self::$db_character_set;
        } }

    
    public function getDbEngine(){ 
        return static::$db_engine;
         }
    
         
    public function collateTableMysql(){
        return "CHARACTER SET '".$this->getCharacterSet()."' COLLATE '".$this->getCollate()."' ENGINE=".$this->getDbEngine()." "  ;
    }
    
    public function collateColumn(){
        return " COLLATE '".$this->getCollate()."'";
    }
    
    
    private function sizeOfField($columnName){
       if($this->hasValidParameterSetting(self::$section_settings,$this->dinamycFields[$columnName]['nameInSettings'],false)){
            return $this->gsetting(self::$section_settings,$this->dinamycFields[$columnName]['nameInSettings']);
        }else{
            return $this->dinamycFields[$columnName]['defaultValue'];
        } 
    }
    
     //devuelve el nombre del campo documento almacenado en la tabla settimgs
  public function nameFieldDocument() {
      //return (hasValidParameterSetting(static::$section_settings,static::$name_field_codocu_settings))?null:
            return $this->gsetting(static::$section_settings,static::$name_field_codocu_settings);
      
  }  
  
  
  //devuelve el nombre del campo documento almacenado en la tabla settimgs
  public function nameFieldStatus() {
      //return (hasValidParameterSetting(static::$section_settings,static::$name_field_status_settings))?null:
           return   $this->gsetting(static::$section_settings,static::$name_field_status_settings);
      
  }
       
    
  
  public function nameFieldCenter() {
      //return (hasValidParameterSetting(static::$section_settings,static::$name_field_status_settings))?null:
             return  $this->gsetting(static::$section_settings,static::$name_field_center_settings);
      
  }
  
   public function existsFk($table,$nameFk)
    {
      if($this->existsTable($table)){
           $fks= array_keys($this->getDb()->getSchema()->getTableSchema($table)->foreignKeys);
         return (in_array($nameFk,$fks))?true:false;
      }else{
         throw new \yii\base\Exception(yii::t('base.errors',' Table \'{tabla}\' doesn\'t exists  ',['tabla'=>$table]));      
         
      }
        
    }
  
    public function existsTable($table){
       if($this->getDb()->getSchema()->getTableSchema($table,true)===null){
           return false;
       }else{
           return true;
       }
    }
  
  
    public function dropFks($table)
    {
      if($this->existsTable($table)){
           $fks= array_keys($this->getDb()->getSchema()->getTableSchema($table)->foreignKeys);
        foreach($fks as $clave=>$nombreFk){
            $this->dropForeignKey($nombreFk, $table);
        }
      }else{
         throw new \yii\base\Exception(yii::t('base.errors',' Table \'{tabla}\' doesn\'t exists  ',['tabla'=>$table]));      
         
      }
        
    }
    
}
