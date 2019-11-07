<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;

/**
 * Class m191031_195027_create_table_examenes
 */
class m191031_195030_create_table_apoderados extends baseMigration
{
    const NAME_TABLE_EDIFICIOS='{{%sigi_edificios}}';
     const NAME_TABLE='{{%sigi_apoderados}}';
     const NAME_TABLE_CLIPRO='{{%clipro}}';
   //const NAME_TABLE_ALUMNO='{{%sta_alu}}';
    /*const NAME_TABLE_CURSOS='{{%sta_materias}}';
     const NAME_TABLE_PERIODOS='{{%sta_periodos}}';*/
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
        'edificio_id'=>$this->integer(11)->notNull(),
         'codpro'=>$this->char(6)->notNull()->append($this->collateColumn()),
        'facturaigv'=>$this->char(1)->append($this->collateColumn()),
        'permite1'=>$this->char(1)->append($this->collateColumn()),
         'permite2'=>$this->char(1)->append($this->collateColumn()),
        'detalles'=>$this->text()->append($this->collateColumn()),
        'permiteventa'=>$this->char(1)->append($this->collateColumn()),
         'permitealquiler'=>$this->char(1)->append($this->collateColumn()),
        ],$this->collateTable());
  
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNO,'codalu');*/
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codpro', static::NAME_TABLE_CLIPRO,'codpro');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'edificio_id', static::NAME_TABLE_EDIFICIOS,'id');
             
            } 
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
     
       if($this->existsTable($table)) {
           //$this->deleteCombo($table, 'tipo');
            $this->dropTable($table);
        }
     

    }

}