<?php
namespace frontend\modules\bigitems\database\migrations;

use console\migrations\baseMigration;

/**
 * Class m190407_172924_create_table_groups
 */
class m190407_172924_create_table_groups extends baseMigration
{
 
    const NAME_TABLE='{{%grupos}}';
     const NAME_TABLE_PLACES='{{%lugares}}';
     //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
     
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

if(!$this->existsTable(static::NAME_TABLE)) {
 $this->createTable(static::NAME_TABLE, [
            'id'=>$this->primaryKey(),
             'lugares_id'=>$this->integer(11),
            'grupo_id'=>$this->integer(11)],
                $this->collateTable());
  $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'lugares_id', self::NAME_TABLE_PLACES,'id');
     
         $this->createIndex('index_ag_748', static::NAME_TABLE, 
                'grupo_id', false);
    }

    
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
          // $this->dropForeignKey('fk_gr46pos_lugares',static::NAME_TABLE);
            
            $this->dropTable(static::NAME_TABLE);
        }

    }

   
}
