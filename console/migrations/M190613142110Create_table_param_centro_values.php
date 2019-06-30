<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190613142110Create_table_param_centro_values
 */
class M190613142110Create_table_param_centro_values extends baseMigration
{
    const NAME_TABLE='{{%parametroscentros}}';
 const NAME_TABLE_CENTROS='{{%centros}}';
 const NAME_TABLE_PARAMETROS='{{%parametros}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable(static::NAME_TABLE)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'codparam'=>$this->char(5)->notNull()->append($this->collateColumn()), //define si es venta o compra
            'codcen' => $this->string(5)->notNull()->append($this->collateColumn()),
            // 'codocu'=>$this->char(5)->notNull()->append($this->collateColumn()), 
            'valor' => $this->text()->append($this->collateColumn()), 
            'valor2' => $this->text()->append($this->collateColumn()), 
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
              'codcen', static::NAME_TABLE_CENTROS,'codcen');
          $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'codparam', static::NAME_TABLE_PARAMETROS,'codparam');
               }
    
    }

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {    $table=static::NAME_TABLE;
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
            $this->dropTable(static::NAME_TABLE);
        }

    }
}
