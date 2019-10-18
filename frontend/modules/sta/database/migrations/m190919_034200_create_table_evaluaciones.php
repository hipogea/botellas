<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


/**
 * */
class m190919_034200_create_table_evaluaciones extends baseMigration
{
     const NAME_TABLE='{{%sta_evaluaciones}}';  
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
        'id'=>$this->primaryKey(),
          'descripcion'=>$this->string(40)->append($this->collateColumn())->notNull(),
          'codalu'=>$this->string(14)->append($this->collateColumn()),
          'codtest'=>$this->string(8)->append($this->collateColumn())->notNull(),
         'fecpro'=>$this->string(20)->append($this->collateColumn())->notNull(),
        'feceje'=>$this->string(20)->append($this->collateColumn())->notNull(),
          'comentario'=>$this->text()->append($this->collateColumn()),
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