<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m191101_195637_create_table_cargos_edificio extends baseMigration
{
    const NAME_TABLE='{{%sigi_cargosedificio}}';
     const NAME_TABLE_EDIFICIOS='{{%sigi_edificios}}';
      const NAME_TABLE_CARGOS='{{%sigi_cargos}}';
     /*const NAME_TABLE_BANCOS='{{%bancos}}';
     const NAME_TABLE_CLIPRO='{{%clipro}}';
     const NAME_TABLE_EDIFICIOS='{{%sigi_edificios}}';
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
        'cargo_id'=>$this->integer(11)->notNull(),
        'tasamora'=>$this->decimal(6,3)->notNull(),
        'plazovencimiento'=>$this->integer(3),   
        ],$this->collateTable());
            $this->addForeignKey($this->generateNameFk($table), $table,
              'edificio_id', static::NAME_TABLE_EDIFICIOS,'id');
             $this->addForeignKey($this->generateNameFk($table), $table,
              'cargo_id', static::NAME_TABLE_CARGOS,'id');
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