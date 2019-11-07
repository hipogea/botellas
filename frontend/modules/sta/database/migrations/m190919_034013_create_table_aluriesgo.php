<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


/**
 * */
class m190919_034013_create_table_aluriesgo extends baseMigration
{
     const NAME_TABLE='{{%sta_aluriesgo}}';
   const NAME_TABLE_PERIODOS='{{%sta_periodos}}';
     const NAME_TABLE_MATERIAS='{{%sta_materias}}';
       const NAME_TABLE_ALUMNOS='{{%sta_alu}}';
        const NAME_TABLE_CARRERAS='{{%sta_carreras}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
          'entrega_id'=>$this->integer(11),
          //'codfac'=>$this->string(8)->append($this->collateColumn()),
          'codcur'=>$this->string(10)->notNull()->append($this->collateColumn()),
          //'activa'=>$this->char(1)->append($this->collateColumn()),
        'codperiodo'=>$this->string(7)->append($this->collateColumn()),
         'codalu'=>$this->string(14)->append($this->collateColumn())->notNull(),
        'nveces'=>$this->integer(2),
         //'electivo'=>$this->char(1)->append($this->collateColumn()),
         //'ciclo'=>$this->integer(2),
        'codcar'=>$this->string(6)->append($this->collateColumn()),
        
        ],$this->collateTable());
   //$this->addPrimaryKey('pk_codmateria',$table, 'codcur');
   /*$this->addForeignKey($this->generateNameFk($table), $table,
              'codcur', static::NAME_TABLE_MATERIAS,'codcur');*/
        $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNOS,'codalu');
        $this->addForeignKey($this->generateNameFk($table), $table,
              'codperiodo', static::NAME_TABLE_PERIODOS,'codperiodo');
                /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codcar', static::NAME_TABLE_CARRERAS,'codcar');*/
            $this->addForeignKey($this->generateNameFk($table), $table,
              'codcar', static::NAME_TABLE_CARRERAS,'codcar');
           
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