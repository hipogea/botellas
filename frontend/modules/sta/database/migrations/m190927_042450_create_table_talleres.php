<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


/**
 * Class m190901_144118_create_table_talleres
 */
class m190927_042450_create_table_talleres extends baseMigration
{
     const NAME_TABLE='{{%sta_talleres}}';
   const NAME_TABLE_FACU='{{%sta_facultades}}';
    const NAME_TABLE_CURSOS='{{%sta_materias}}';
     const NAME_TABLE_PERIODOS='{{%sta_periodos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
         'numero'=>$this->string(8)->append($this->collateColumn()),
          'codfac'=>$this->string(8)->notNull()->append($this->collateColumn()),
        'codtra'=>$this->string(6)->notNull()->append($this->collateColumn()),
        'codtra_psico'=>$this->string(6)->notNull()->append($this->collateColumn()),
        'fopen'=>$this->char(10)->notNull()->append($this->collateColumn()),
         'fclose'=>$this->char(10)->notNull()->append($this->collateColumn()),
          'codcur'=>$this->string(10)->notNull()->append($this->collateColumn()),
          'activa'=>$this->char(1)->append($this->collateColumn()),
         'codperiodo'=>$this->string(6)->notNull()->append($this->collateColumn()),
         'codfac'=>$this->string(8)->notNull()->append($this->collateColumn()),
         'electivo'=>$this->char(1)->append($this->collateColumn()),
         'ciclo'=>$this->integer(2),
         'duracioncita'=>$this->integer(3),
        'tolerancia'=>$this->decimal(4,2),
        'codocu'=>$this->char(3)->append($this->collateColumn()),
        'descripcion'=>$this->string(40)->notNull()->append($this->collateColumn()),
         'detalles'=>$this->text()->append($this->collateColumn()),
         
        ],$this->collateTable());
  
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codfac', static::NAME_TABLE_FACU,'codfac');
   /* $this->addForeignKey($this->generateNameFk($table), $table,
              'codcur', static::NAME_TABLE_CURSOS,'codcur');*/
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codperiodo', static::NAME_TABLE_PERIODOS,'codperiodo');
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