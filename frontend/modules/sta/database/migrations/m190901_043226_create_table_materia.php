<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m190901_043226_create_table_materia extends baseMigration
{
     const NAME_TABLE='{{%sta_materia}}';
   const NAME_TABLE_CARRERAS='{{%sta_carreras}}';
    const NAME_TABLE_CURSOS='{{%sta_cursos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
                'id'=>$this->primaryKey(),
               'codcur'=>$this->string(10)->notNull()->append($this->collateColumn()),
               //'nomcur'=>$this->string(60)->append($this->collateColumn()),
             'activa'=>$this->char(1)->append($this->collateColumn()),
         'creditos'=>$this->integer(2),
         'codcar'=>$this->string(6)->notNull()->append($this->collateColumn()),
         'electivo'=>$this->char(1)->append($this->collateColumn()),
         'ciclo'=>$this->integer(2),
        
        ],$this->collateTable());
   //$this->addPrimaryKey('pk_codmateria',$table, ['codcur','codcar']);
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codcar', static::NAME_TABLE_CARRERAS,'codcar');
             $this->addForeignKey($this->generateNameFk($table), $table,
              'codcur', static::NAME_TABLE_CURSOS,'codcur');
            
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