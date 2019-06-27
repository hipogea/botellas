<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190512174455Create_table_convermoney
 */
class M190512174455Create_table_convermoney extends Migration
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
       // echo "M190512174455Create_table_convermoney cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M190512174455Create_table_convermoney cannot be reverted.\n";

        return false;
    }
    */
}
