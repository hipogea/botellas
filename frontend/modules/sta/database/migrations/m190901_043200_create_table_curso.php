<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m190901_043200_create_table_curso extends baseMigration
{
     const NAME_TABLE='{{%sta_cursos}}';
   //const NAME_TABLE_CARRERAS='{{%sta_carreras}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
               'codcur'=>$this->string(10)->append($this->collateColumn()),
               'nomcur'=>$this->string(70)->append($this->collateColumn()),
             
        ],$this->collateTable());
   $this->addPrimaryKey('pk_codcurso',$table, 'codcur');
    
                /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codcar', static::NAME_TABLE_CARRERAS,'codcar');*/
            
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