<?php
namespace console\migrations;
use yii\db\Migration;
use backend\components\Installer;

class baseMigration extends Migration
{
      
    public function isMySql(){
        return ($this->db->driverName === 'mysql')?true:false;
            
    }
    
    public function getCollate(){ 
        return Installer::readEnv('DB_COLLATE', 'utf8_unicode_ci');
    }
    
    public function getCharacterSet(){ 
        return Installer::readEnv('DB_CHARSET', 'utf8');
       }

    
    public function getDbEngine(){ 
       return Installer::readEnv('DB_ENGINET', 'InnoDB');
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
            /*genera un unico nomrbe a una clave ajemna*/
    public function generateNameFk($tablex){
        //if($tablex===null or $tablex=='')
            //$tablex='unk';
       // $tablex=preg_match("[^A-Za-z0-9]", "", $tablex);
        $val='fk_'.Installer::generateRandomString(16);
         //$val= preg_match("[^A-Za-z0-9]", "", $val);
        return $val;
    }        
            
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

