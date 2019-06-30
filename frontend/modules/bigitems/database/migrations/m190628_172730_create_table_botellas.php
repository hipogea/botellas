<?php
namespace frontend\modules\bigitems\database\migrations;
use yii\db\Migration;
use console\migrations\baseMigration;
/**
 * Class m190628_172730_create_table_botellas
 */
class m190628_172730_create_table_botellas extends baseMigration
{
     const NAME_TABLE='{{%botellas}}';
 const NAME_TABLE_ACTIVOS='{{%activos}}';
//const NAME_TABLE_UM='{{%ums}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
             'codigo1' => $this->string(12)->notNull()->append($this->collateColumn()),
             'codigo2' => $this->string(12)->notNull()->append($this->collateColumn()),
             'codigo3'=>$this->string(12)->notNull()->append($this->collateColumn()),
                'peso'=>$this->double(),
              'activo_id'=>$this->integer(11),
        'sustancia'=>$this->char(3)->notNull()->append($this->collateColumn()),
        
             
                        ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
              'activo_id', static::NAME_TABLE_ACTIVOS,'id');
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
