<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


/**
 * Class m191031_043554_create_table_examenes
 */
class m191031_043540_create_table_test_taller extends baseMigration
{
   const NAME_TABLE_TALLERES='{{%sta_talleres}}';
     const NAME_TABLE='{{%sta_testtalleres}}';
     //const NAME_TABLE_TESTS='{{%sta_test}}';
   //const NAME_TABLE_ALUMNO='{{%sta_alu}}';
    /*const NAME_TABLE_CURSOS='{{%sta_materias}}';
     const NAME_TABLE_PERIODOS='{{%sta_periodos}}';*/
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
       // 'aluriesgo_id'=>$this->integer(11)->notNull(),
        'taller_id'=>$this->integer(11)->notNull(),
        'codtest'=>$this->string(8)->notNull(),
        'peso'=>$this->integer(2),
         'obligatorio'=>$this->char(1)->append($this->collateColumn()),
        ],$this->collateTable());
  
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNO,'codalu');*/
    $this->addForeignKey($this->generateNameFk($table), $table,
              'taller_id', static::NAME_TABLE_TALLERES,'id');
    
            } 
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
       if($this->existsTable($table)) {
            $this->dropTable($table);
        }

    }

}