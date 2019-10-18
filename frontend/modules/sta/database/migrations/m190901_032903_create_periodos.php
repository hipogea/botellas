<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;

/**
 * Class m190901_032903_create_periodos
 */
class m190901_032903_create_periodos  extends baseMigration
{
     const NAME_TABLE='{{%sta_periodos}}';
   
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
               'codperiodo'=>$this->string(7)->append($this->collateColumn()),
               'periodo'=>$this->string(40)->append($this->collateColumn()),
             'activa'=>$this->char(1)->append($this->collateColumn()),
       
        ],$this->collateTable());
   $this->addPrimaryKey('pk_codper',$table, 'codperiodo');
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