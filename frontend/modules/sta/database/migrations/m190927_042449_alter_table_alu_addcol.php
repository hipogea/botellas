<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


class m190927_042449_alter_table_alu_addcol extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const NAME_TABLE='{{%sta_alu}}';
    public function safeUp()
    {
         /** Agregando una columna a la tabla Direcciones
         * con su respectiva llave foranes
         */
        $table=static::NAME_TABLE;
        //var_dump($table);die();
        if(!$this->existsColumn($table,'celulares')){         
            $this->addColumn($table,
                 'celulares', 
                 $this->string(23)->append($this->collateColumn())
                 );
        }
        if(!$this->existsColumn($table,'fijos')){         
            $this->addColumn($table,
                 'fijos', 
                 $this->string(14)->append($this->collateColumn())
                 );
        }
        if(!$this->existsColumn($table,'correo')){         
            $this->addColumn($table,
                 'correo', 
                 $this->string(54)->append($this->collateColumn())
                 );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE;
        if($this->existsColumn($table,'celulares')){ 
            $this->dropColumn($table,'celulares');
        }
        if($this->existsColumn($table,'fijos')){ 
            $this->dropColumn($table,'fijos');
        }
        if($this->existsColumn($table,'correo')){ 
            $this->dropColumn($table,'correo');
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
