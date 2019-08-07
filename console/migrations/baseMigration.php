<?php
namespace console\migrations;
use yii\db\Migration;
use backend\components\Installer;
use common\models\masters\ModelCombo; //la tabla de combos padre config
use common\models\masters\Combovalores;
/*
 * Clase definida para ayudar asimplificar los procesos de migracion 
 * valido solo para MYSQL
 * uSELA Y VERA COMO LE SIMPLKIFICA LA VIDA 
 */
class baseMigration extends Migration
{
      
    public function isMySql(){
        return ($this->db->driverName === 'mysql')?true:false;
            
    }
    
    public function getCollate(){ 
        return trim(Installer::readEnv('DB_COLLATE', 'utf8_unicode_ci'));
    }
    
    public function getCharacterSet(){ 
        return trim(Installer::readEnv('DB_CHARSET', 'utf8'));
       }

    
    public function getDbEngine(){ 
       return trim(Installer::readEnv('DB_ENGINET', 'InnoDB'));
         }
    
         
    public function collateTable(){
        if($this->isMySql())
        return "CHARACTER SET '".$this->getCharacterSet()."' COLLATE '".$this->getCollate()."' ENGINE=".$this->getDbEngine()." "  ;
        return "";
    }
    
    public function collateColumn(){
        return " COLLATE '".$this->getCollate()."'";
    }
    
  
   public function existsFk($table,$nameFk)
    {
      if($this->existsTable($table)){
           $fks= array_keys($this->getTable($table)->foreignKeys);
         return (in_array($nameFk,$fks))?true:false;
      }else{
         throw new \yii\base\Exception(yii::t('base.errors',' Table \'{tabla}\' doesn\'t exists  ',['tabla'=>$table]));      
         
      }
        
    }
  
    public function existsTable($table){
       if($this->getTable($table,true)===null){
           return false;
       }else{
           return true;
       }
    }
  
  
    public function dropFks($table)
    {
      if($this->existsTable($table)){
           $fks= array_keys($this->getTable($table)->foreignKeys);
        foreach($fks as $clave=>$nombreFk){
            $this->dropForeignKey($nombreFk, $table);
        }
      }else{
         throw new \yii\base\Exception(yii::t('base.errors',' Table \'{tabla}\' doesn\'t exists  ',['tabla'=>$table]));      
         
      }
        
    }     
            /*genera un unico nomrbe a una clave ajemna*/
    public function generateNameFk($tablex){
        //if($tablex===null or $tablex=='')
            //$tablex='unk';
       // $tablex=preg_match("[^A-Za-z0-9]", "", $tablex);
        $val='fk_'.Installer::generateRandomString(16);
         //$val= preg_match("[^A-Za-z0-9]", "", $val);
        return $val;
    }   
    
    /*Esta funcion registra los valores clave de los cmpos en la tabla comoo valores 
     * por ejemplo  
     *   codestado=> 100=>CREADO, 200=>ANULADO .etc 
     */
    public function putCombo($table,$namefield,$valor){
       
        $tableSchema=$this->getTable($table);
       $campos=$tableSchema->columns;
       $realNameTable=str_replace($this->getPrefix(),'',$tableSchema->name);
       $largo=$campos[$namefield]->size;unset($campos);
       if($largo==1){
         $code='A';  
       }else{
          $code=str_pad('1', $largo, '0', STR_PAD_RIGHT); 
       }
        
         ModelCombo::firstOrCreateStatic([
            'parametro'=>$realNameTable.'.'.$namefield,
            'clavecentro'=>'0',
            ]);
            Combovalores::firstOrCreateStatic([
            'nombretabla'=>$realNameTable.'.'.$namefield,
            'codigo'=>$code,
             'valor'=>$valor,
            ]);
        
        
    }
  
    private function getTable($table,$refresh=false){
     return $this->getDb()->getSchema()->getTableSchema($table,$refresh);   
    }
    
    public function getPrefix(){
     return $this->getDb()->tablePrefix;   
    }
            
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

