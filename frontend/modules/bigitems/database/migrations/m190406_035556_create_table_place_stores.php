<?php
namespace frontend\modules\bigitems\database\migrations;

use console\migrations\baseMigration;


/**
 * Class m190406_035556_create_table_place_stores
 */
class m190406_035556_create_table_place_stores extends baseMigration
{
     
     const NAME_TABLE='{{%lugares}}';
     const NAME_TABLE_DIRECCIONES='{{%direcciones}}';
    public function safeUp()
    {
        $table=static::NAME_TABLE;
   if(!$this->existsTable($table)) {
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'direcciones_id'=>$this->integer(11),
            'nombre'=>$this->string(40)->append($this->collateColumn()),  
               'tienerecepcion'=>$this->char(1)->append($this->collateColumn()),
             'tipo'=>$this->char(1)->append($this->collateColumn()),
           ],
                $this->collateTable());
        
         $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'direcciones_id', self::NAME_TABLE_DIRECCIONES,'id');
       $this->putCombo($table, 'tipo', 'NO MOVIL');
        
    }
    }
      public function safeDown()
    {
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
           // $this->dropForeignKey('fk_lugares_direcciones',static::NAME_TABLE);
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
        echo "m190406_035556_create_table_place_stores cannot be reverted.\n";

        return false;
    }
    */
}
