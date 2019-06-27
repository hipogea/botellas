<?php
namespace console\migrations;
use console\migrations\baseMigration;


/**
 * Class m190107_153346_fill_table_sociedades
 */
class m190107_153346_fill_table_sociedades extends baseMigration
{
    /**
     * {@inheritdoc}
     */
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
        echo "m190107_153346_fill_table_sociedades cannot be reverted.\n";

        return false;
    }
    */
}
