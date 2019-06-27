<?php
namespace console\migrations;
use console\migrations\baseMigration;

/**
 * Class m190106_182649_test_table_centros
 */
class m190106_182649_test_table_centros extends baseMigration
{
   
    const NAME_TABLE='{{%centros}}';
    const NAME_TABLE_SOCIEDADES='{{%sociedades}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
 
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
            'codcen' => $this->string(5)->append($this->collateColumn()),
            'nomcen' => $this->string(60)->notNull()->append($this->collateColumn()), 
            'codsoc'=>$this->char(1)->notNull()->append($this->collateColumn()), 
            'descricen'=>$this->text()->append($this->collateColumn()),
             ], $this->collateTable());
       $this->addPrimaryKey('pk_centros45',static::NAME_TABLE, 'codcen');
      $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codsoc', self::NAME_TABLE_SOCIEDADES,'socio');
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
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
}
