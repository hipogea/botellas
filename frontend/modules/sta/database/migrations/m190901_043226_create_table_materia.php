<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m190901_043226_create_table_materia extends baseMigration
{
     const NAME_TABLE='{{%sta_materias}}';
   const NAME_TABLE_FACU='{{%sta_facultades}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
               'codcur'=>$this->string(10)->append($this->collateColumn()),
               'nomcur'=>$this->string(40)->append($this->collateColumn()),
             'activa'=>$this->char(1)->append($this->collateColumn()),
         'creditos'=>$this->integer(2),
         'codfac'=>$this->string(8)->append($this->collateColumn()),
         'electivo'=>$this->char(1)->append($this->collateColumn()),
         'ciclo'=>$this->integer(2),
        
        ],$this->collateTable());
   $this->addPrimaryKey('pk_codmateria',$table, 'codcur');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codfac', static::NAME_TABLE_FACU,'codfac');
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