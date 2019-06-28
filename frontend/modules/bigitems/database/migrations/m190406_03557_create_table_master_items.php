<?php
namespace frontend\modules\bigitems\database\migrations;

use console\migrations\baseMigration;


/**
 * Class m190406_152553_create_table_master_items
 */
class m190406_035557_create_table_master_items extends baseMigration
{
   const NAME_TABLE='{{%mastercomponentes}}';
   
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
if(!$this->existsTable(static::NAME_TABLE)) {
        $this->createTable(static::NAME_TABLE, [
            'id'=>$this->primaryKey(),
            'parent_id'=>$this->integer(11),
            'codigo'=>$this->string(10)->append($this->collateColumn()),
            'descripcion'=>$this->string(40)->append($this->collateColumn()),
            'marca'=>$this->string(30)->append($this->collateColumn()),
            'modelo'=>$this->string(30)->append($this->collateColumn()),
            'numeroparte'=>$this->string(30)->append($this->collateColumn()),
            'codigoitem'=>$this->string($this->specialSizeFor('codigoitem'))->append($this->collateColumn()),
            'direccion_id'=>$this->integer(11)->comment('CAMPO AUXILIAR, SE USA CUANDO SE TRABNAJA SIN LUGARES SOLO CON DIRECCIONES'), 
            'escontenedor'=>$this->char(1)->append($this->collateColumn())],

                $this->collateTable());
        $this->createIndex('index_codigo', static::NAME_TABLE, 
                'codigo', true);
         $this->createIndex('index_parent_id', static::NAME_TABLE, 
                'parent_id', true);
        
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_152553_create_table_master_items cannot be reverted.\n";

        return false;
    }
    */
}
