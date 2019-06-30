<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190614205412Create_table_user_centros
 */
class M190614205412Create_table_user_centros extends baseMigration
{
       const NAME_TABLE='{{%usercentros}}';
 const NAME_TABLE_CENTROS='{{%centros}}';
 const NAME_TABLE_USER='{{%user}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable(static::NAME_TABLE)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(11)->notNull(), //define si es venta o compra
            'codcen' => $this->string(5)->notNull()->append($this->collateColumn()),
            // 'codocu'=>$this->char(5)->notNull()->append($this->collateColumn()), 
            //'valor' => $this->text()->append($this->collateColumn()), 
            //'valor2' => $this->text()->append($this->collateColumn()), 
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
              'codcen', static::NAME_TABLE_CENTROS,'codcen');
          $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'user_id', static::NAME_TABLE_USER,'id');
               }
}

public function safeDown()
    {
        $table=static::NAME_TABLE;
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
            $this->dropTable(static::NAME_TABLE);
        }

    }

}
