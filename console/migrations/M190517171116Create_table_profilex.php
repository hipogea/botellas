<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190517171116Create_table_profile
 */
class M190517171116Create_table_profilex extends baseMigration
{

 const NAME_TABLE='{{%profile}}';
  const NAME_TABLE_USER='{{%user}}';
  // const NAME_TABLE_MAESTRO='{{%maestrocompo}}';
    public function safeUp()
    {     
        $table=self::NAME_TABLE;
if (!$this->existsTable($table)) {
        $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(11),
            'duration'=>$this->integer(11),
             'durationabsolute'=>$this->integer(11),
            'names' => $this->string(60)->append($this->collateColumn()),
            'photo' => $this->text()->append($this->collateColumn()),
            'detalle'=>$this->text()->append($this->collateColumn()),
            
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
              'user_id', static::NAME_TABLE_USER,'id');
        
      
               }
    
    }

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
            $this->dropTable(static::NAME_TABLE);
        }

    }
}
