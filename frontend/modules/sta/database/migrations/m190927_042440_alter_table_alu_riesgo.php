<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


class m190927_042440_alter_table_alu_riesgo extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const NAME_TABLE='{{%sta_aluriesgo}}';
    public function safeUp()
    {
         /** Agregando una columna a la tabla Direcciones
         * con su respectiva llave foranes
         */
        $table=static::NAME_TABLE;
        //var_dump($table);die();
        if(!$this->existsColumn($table,'status')){         
            $this->addColumn($table,
                 'status', 
                 $this->char(1)->append($this->collateColumn())
                 );
        }
        if(!$this->existsColumn($table,'programa_id')){         
            $this->addColumn($table,
                 'programa_id', 
                 $this->integer(11)
                 );
        }
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE;
        if($this->existsColumn($table,'status')){ 
            $this->dropColumn($table,'status');
        }
        if($this->existsColumn($table,'programa_id')){ 
            $this->dropColumn($table,'programa_id');
        }       
       
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
