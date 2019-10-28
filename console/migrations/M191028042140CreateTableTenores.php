<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M191028042140CreateTableTenores
 */
class M191028042140CreateTableTenores extends baseMigration
{

 const NAME_TABLE='{{%tenores}}';
 const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       
 $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'codocu'=>$this->char(3)->notNull()->append($this->collateColumn()),
            'activo' =>$this->char(1)->append($this->collateColumn()),
        'posic' =>$this->char(1)->append($this->collateColumn()),//a, b, c, d cebcera, centro pie
            'texto' => $this->text()->append($this->collateColumn()),
            //'ishome' => $this->char(1)->append($this->collateColumn()),
            'order'=> $this->integer(3),
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
              'codocu', static::NAME_TABLE_DOCUMENTOS,'codocu');
           }
    
    }

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE; 
       if ($this->existsTable($table)){
            $this->dropTable($table);
        }

    }
}
