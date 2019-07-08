<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190508053817Alter_table_direcciones_add_column
 */
class M190508053817Alter_table_direcciones_add_column extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const NAME_TABlE_DIRECCIONES='{{%direcciones}}';
    const NAME_TABlE_CLIPRO='{{%clipro}}';
    public function safeUp()
    {
/*
         * Agregando una columna a la tabla Direcciones
         * con su respectiva llave foranes
         */
        $table=static::NAME_TABlE_DIRECCIONES;
        if($this->existsTable($table)) {
          if(is_null($this->getDb()->getSchema()
                ->getTableSchema($table)->
                getColumn('codpro'))){
            $this->addColumn($table,
                 'codpro', 
                 $this->char(6)->notNull()->append($this->collateColumn())
                 );
            
             $this->addForeignKey('fk_direc_clxxiprod56', $table,
              'codpro', static::NAME_TABlE_CLIPRO,'codpro');
        
        }
        
        }
        
         
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      /* $this->dropForeignKey(
            'fk_direc_clxxiprod56',
            static::NAME_TABlE_DIRECCIONES
        );
        
         $table=static::NAME_TABlE_DIRECCIONES;
        if($this->existsTable($table)) {
            if(!is_null($this->getDb()->getSchema()
                ->getTableSchema($table)->
                getColumn('codpro')))
                $this->dropColumn(            
            $table,'codpro'
        );
        }*/
 
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M190508053817Alter_table_direcciones_add_column cannot be reverted.\n";

        return false;
    }
    */
}
