<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190520025546Create_table_param_docs
 */
class M190520025546Create_table_param_docs extends baseMigration
{

 const NAME_TABLE='{{%parametrosdocu}}';
 const NAME_TABLE_PARAMETROS='{{%parametros}}';
  const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
             'id'=>$this->primaryKey(),
            'codparam'=>$this->char(5)->notNull()->append($this->collateColumn()),
            'codocu' => $this->char(5)->notNull()->append($this->collateColumn()),
            
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'codparam', static::NAME_TABLE_PARAMETROS,'codparam');
            $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'codocu', static::NAME_TABLE_DOCUMENTOS,'codocu');
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
}
