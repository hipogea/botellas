<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;

class m191101_140312_create_table_unidades extends baseMigration
{
    const NAME_TABLE='{{%sigi_unidades}}';
     const NAME_TABLE_TIPOUNIDADES='{{%sigi_tipounidad}}';
    const NAME_TABLE_EDIFICIOS='{{%sigi_edificios}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
        'codtipo'=>$this->char(4)->notNull()->append($this->collateColumn()),
        'npiso'=>$this->integer(3)->notNull(),
        'edificio_id'=>$this->integer(11)->notNull(),
        'numero'=>$this->string(12)->notNull()->append($this->collateColumn()),
        'nombre'=>$this->string(25)->notNull()->append($this->collateColumn()),
        'area'=>$this->decimal(10,3),
        'participacion'=>$this->decimal(10,4),
        'parent_id'=>$this->integer(11),
        'detalles'=>$this->text()->append($this->collateColumn()),
        ],$this->collateTable());
  
    $this->addForeignKey($this->generateNameFk($table), $table,
              'edificio_id', static::NAME_TABLE_EDIFICIOS,'id');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codtipo', static::NAME_TABLE_TIPOUNIDADES,'codtipo');
            } 
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
       if($this->existsTable($table)) {
            $this->dropTable($table);
        }

    }

}