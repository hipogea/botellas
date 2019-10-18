<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


class m191006_193800_alter_table_aluriesgo extends baseMigration
{
   
    /**
     * {@inheritdoc}
     */
    const NAME_TABLE='{{%sta_aluriesgo}}';
    public function safeUp()
    {
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190927_042447_alter_table_alu_addcol cannot be reverted.\n";

        return false;
    }
    */
}
