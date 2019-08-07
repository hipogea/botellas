<?php

namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
/**
 * Class m190710_152206_modify_table_users
 */
class m190710_152206_modify_table_profile extends baseMigration
{
     const NAME_TABLE='{{%profile}}';
     //const NAME_TABLE_FACULTADES='{{%sta_facultades}}';
 //const NAME_TABLE_DOCBOTELLAS='{{%bigitems_docbotellas}}';
  //const NAME_TABLE_ACTIVOS='{{%activos}}';
//const NAME_TABLE_UM='{{%ums}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if($this->existsTable($table)) {
     $tableSchema = $this->db->getSchema()->getTableSchema($table);
     $columns = $tableSchema->getColumnNames();
     if (!in_array('tipo', $columns)) {
       $this->addColumn($table, 'tipo', $this->char(2)->append($this->collateColumn()));
            }
         $this->putCombo($table, 'tipo', 'ALUMNO EN RIESGO');   
            
     }
   
}
 

public function safeDown()
    {
    $table=static::NAME_TABLE;
     $tableSchema = $this->db->getSchema()->getTableSchema($table);
     if (!is_null($tableSchema)) {
         $columns = $tableSchema->getColumnNames();
     if (in_array('tipo', $columns)) {
         $this->dropColumn($table, 'tipo');
            } 
     }
    
    }

}
