<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;

class m191101_194414_create_table_cargos extends baseMigration
{
    const NAME_TABLE='{{%sigi_cargos}}';
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
        'codcargo'=>$this->char(5)->notNull()->append($this->collateColumn()),
        'descargo'=>$this->string(40)->notNull()->append($this->collateColumn()),
        'esegreso'=>$this->char(1)->notNull()->append($this->collateColumn()),
        'regular'=>$this->char(1)->notNull()->append($this->collateColumn()),        
        ],$this->collateTable());
     
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