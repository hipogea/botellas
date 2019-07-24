<?php
namespace console\migrations;
use console\migrations\baseMigration;

/**
 * Class M190723135624Create_table_avlores_default
 */
class M190723135624Create_table_avlores_default extends baseMigration
{
    const NAME_TABLE='{{%valoresdefault}}';
 const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
 //const NAME_TABLE_PARAMETROS='{{%parametros}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable(static::NAME_TABLE)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'codocu'=>$this->char(3)->notNull()->append($this->collateColumn()), //define si es venta o compra
            'user_id' => $this->integer(4)->notNull(),
            'nombrecampo'=>$this->string(50)->notNull()->append($this->collateColumn()), 
            'valor' => $this->text()->append($this->collateColumn()), 
         'activo' => $this->char(1)->append($this->collateColumn()), 
            'aliascampo' => $this->string(50)->append($this->collateColumn()), 
             ],$this->collateTable());
        // $this->addForeignKey($this->generateNameFk($table), $table,
             // 'codocu', static::NAME_TABLE_DOCUMENTOS,'codocu');
         /* $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'codparam', static::NAME_TABLE_PARAMETROS,'codparam');*/
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
