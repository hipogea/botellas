<?php
namespace console\migrations;
use console\migrations\baseMigration;


class m190106_063220_create_table_centros extends baseMigration
{
   
    public function safeUp()
    {
 
    }

    
    
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
}
