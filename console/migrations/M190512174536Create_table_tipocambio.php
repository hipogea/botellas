<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190512174536Create_table_tipocambio
 */
class M190512174536Create_table_tipocambio extends Migration
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
       // echo "M190512174536Create_table_tipocambio cannot be reverted.\n";
      return true;
       // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M190512174536Create_table_tipocambio cannot be reverted.\n";

        return false;
    }
    */
}
