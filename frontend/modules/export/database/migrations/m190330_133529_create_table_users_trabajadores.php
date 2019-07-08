<?php
namespace frontend\modules\people\database\migrations;

use console\migrations\baseMigration;
/**
 * Class m190330_133529_create_table_users_trabajadores
 */
class m190330_133529_create_table_users_trabajadores extends baseMigration
{
   

 const NAME_TABLE='{{%users_trabajadores}}';
 const NAME_TABLE_USUARIOS='{{%user}}';
 const NAME_TABLE_TRABAJADORES='{{%trabajadores}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
              'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull()->append($this->collateColumn()),  
             'id_traba' => $this->integer()->notNull()->append($this->collateColumn()),  
             'activo'=>$this->char(1)->append($this->collateColumn()),
             ], $this->collateTable());
      // $this->addPrimaryKey('pk_parametros4t45',static::NAME_TABLE, 'codparam');     
        $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'id_traba', self::NAME_TABLE_TRABAJADORES,'id');
        $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'id_user', self::NAME_TABLE_USUARIOS,'id');
        }
      
      }  
        
    

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
            $this->dropTable(static::NAME_TABLE);
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190330_133529_create_table_users_trabajadores cannot be reverted.\n";

        return false;
    }
    */
}
