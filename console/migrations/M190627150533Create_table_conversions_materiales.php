<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190627150533Create_table_conversions_materiales
 */
class M190627150533Create_table_conversions_materiales extends baseMigration
{
     const NAME_TABLE='{{%conversiones}}';
 const NAME_TABLE_MAESTRO='{{%maestrocompo}}';
const NAME_TABLE_UM='{{%ums}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
             'codum1' => $this->string(4)->notNull()->append($this->collateColumn()),
             'codum2' => $this->string(4)->notNull()->append($this->collateColumn()),
             'valor1'=>$this->double()->notNull(),
             'valor2'=>$this->double()->notNull(),
        'codart' => $this->string(14)->notNull()->append($this->collateColumn()),
             
                        ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
              'codum1', static::NAME_TABLE_UM,'codum');
          $this->addForeignKey($this->generateNameFk($table), $table,
              'codum2', static::NAME_TABLE_UM,'codum');
          $this->addForeignKey($this->generateNameFk($table), $table,
              'codart', static::NAME_TABLE_MAESTRO,'codart');
               }
}

public function safeDown()
    {    $table=static::NAME_TABLE;
       if($this->existsTable($table)) {
            $this->dropTable($table);
        }

    }

}
