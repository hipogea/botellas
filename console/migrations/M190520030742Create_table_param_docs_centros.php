<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190520030742Create_table_param_docs_centros
 */
class M190520030742Create_table_param_docs_centros extends  baseMigration
{

 const NAME_TABLE='{{%parametrosdocucentros}}';
 const NAME_TABLE_CENTROS='{{%centros}}';
 const NAME_TABLE_PARAMETROS='{{%parametros}}';
 const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if ($this->db->schema->getTableSchema($table, true) === null) {
        $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'codparam'=>$this->char(5)->notNull()->append($this->collateColumn()), //define si es venta o compra
            'codcen' => $this->string(5)->notNull()->append($this->collateColumn()),
             'codocu'=>$this->char(5)->notNull()->append($this->collateColumn()), 
            'valor' => $this->text()->append($this->collateColumn()), 
            'valor2' => $this->text()->append($this->collateColumn()), 
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
              'codcen', static::NAME_TABLE_CENTROS,'codcen');
          $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'codparam', static::NAME_TABLE_PARAMETROS,'codparam');
              $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'codocu', static::NAME_TABLE_DOCUMENTOS,'codocu');
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
