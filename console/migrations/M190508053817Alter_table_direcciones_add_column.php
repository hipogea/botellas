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
        if(is_null($this->getDb()->getSchema()
                ->getTableSchema(static::NAME_TABlE_DIRECCIONES)->
                getColumn('codpro'))){
            $this->addColumn(static::NAME_TABlE_DIRECCIONES,
                 'codpro', 
                 $this->char(6)->notNull()->append($this->collateColumn())
                 );
         /*$this->addForeignKey('fk_direc_cliprod56', static::NAME_TABLE_DIRECCIONES,
              'codpro', self::NAME_TABLE_CLIPRO,'codpro');*/
        }
         
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /* $this->dropForeignKey(
            'fk_direc_cliprod56',
            static::NAME_TABlE_DIRECCIONES
        );*/
 if(!is_null($this->getDb()->getSchema()
                ->getTableSchema(static::NAME_TABlE_DIRECCIONES)->
                getColumn('codpro')))
$this->dropColumn(
            
            static::NAME_TABlE_DIRECCIONES,'codpro'
        );
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
