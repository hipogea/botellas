<?php
namespace frontend\modules\bigitems\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m190406_035348_create_table_assets
 */
class m190406_035348_create_table_assets extends baseMigration
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
        echo "m190406_035348_create_table_assets cannot be reverted.\n";

        return false;
    }
    */
}
