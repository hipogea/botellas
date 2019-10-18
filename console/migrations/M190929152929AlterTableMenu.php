<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190929152929AlterTableMenu
 */
class M190929152929AlterTableMenu extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const NAME_TABLE='{{%menu}}';
    public function safeUp()
    {
         /** Agregando una columna a la tabla Direcciones
         * con su respectiva llave foranes
         */
        $table=static::NAME_TABLE;
        //var_dump($table);die();
        if(!$this->existsColumn($table,'icon')){         
            $this->addColumn($table,
                 'icon', 
                 $this->string(35)->append($this->collateColumn())
                 );
        }
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE;
        if($this->existsColumn($table,'icon')){ 
            $this->dropColumn($table,'icon');
        }
       
       
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M190929152929AlterTableMenu cannot be reverted.\n";

        return false;
    }
    */
}
