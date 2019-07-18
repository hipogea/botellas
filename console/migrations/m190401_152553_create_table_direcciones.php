<?php

namespace console\migrations;
use console\migrations\baseMigration;


/**
 * Class m190406_044824_create_table_direcciones
 */
class m190401_152553_create_table_direcciones extends baseMigration
{
   const NAME_TABLE='{{%direcciones}}';
     
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            
if(!$this->existsTable(static::NAME_TABLE)) {
   // $this->assignFks();   
        $this->createTable(static::NAME_TABLE, [
            'id'=>$this->primaryKey(),
            'direc'=>$this->string(80)->append($this->collateColumn()), 
            
             'coddepa'=>$this->char(3)->append($this->collateColumn()),
            'coddist'=>$this->char(9)->append($this->collateColumn()),  
               'codprov'=>$this->char(6)->append($this->collateColumn()),
            
               'nomlug'=>$this->string(20)->append($this->collateColumn()),
            'distrito'=>$this->string(25)->append($this->collateColumn()),  
               'provincia'=>$this->string(30)->append($this->collateColumn()),
             'departamento'=>$this->string(30)->append($this->collateColumn()),
            'latitud'=>$this->string(15)->append($this->collateColumn()),
             'meridiano'=>$this->string(15)->append($this->collateColumn()),],
                $this->collateTable());
       
        }
    }

      public function safeDown()
    {
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
            $this->dropTable(static::NAME_TABLE);
        }

    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_044824_create_table_direcciones cannot be reverted.\n";

        return false;
    }
    */
}
