<?php
namespace console\migrations;
use console\migrations\baseMigration;

class M190805050720CreateTableObjcli extends baseMigration
{
    const NAME_TABLE='{{%objcli}}';
 const NAME_TABLE_CLIPRO='{{%clipro}}';
 //const NAME_TABLE_PARAMETROS='{{%parametros}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
               'id'=>$this->primaryKey(),
         'codpro' => $this->char(6)->notNull()->append($this->collateColumn()),
         'descripcion' => $this->string(26)->notNull()->append($this->collateColumn()),
           'codigo' => $this->char(3)->notNull()->append($this->collateColumn()), 
        ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
             'codpro', static::NAME_TABLE_CLIPRO,'codpro');
         
         /* $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'codparam', static::NAME_TABLE_PARAMETROS,'codparam');*/
               }
    
}

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {    $table=static::NAME_TABLE;
      if($this->existsTable($table)){
            $this->dropTable($table);
        }

    }
}
