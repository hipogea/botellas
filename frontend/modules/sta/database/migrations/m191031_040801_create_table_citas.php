<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


/**
 * Class m190901_144118_create_table_talleres
/**
 * Class m191031_040801_create_table_citas
 */
class m191031_040801_create_table_citas extends baseMigration
{
   const NAME_TABLE='{{%sta_citas}}';
     const NAME_TABLE_TALLERESDET='{{%sta_talleresdet}}';
      const NAME_TABLE_TALLERES='{{%sta_talleres}}';
     const NAME_TABLE_TRABAJADORES='{{%trabajadores}}';
   //const NAME_TABLE_ALUMNO='{{%sta_alu}}';
    /*const NAME_TABLE_CURSOS='{{%sta_materias}}';
     const NAME_TABLE_PERIODOS='{{%sta_periodos}}';*/
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
       // 'aluriesgo_id'=>$this->integer(11)->notNull(),
        'talleresdet_id'=>$this->integer(11)->notNull(),
         'talleres_id'=>$this->integer(11)->notNull(),//Rompiendo la normalizacion 
        'fechaprog'=>$this->string(19)->append($this->collateColumn()),
        'codtra'=>$this->string(14)->notNull()->append($this->collateColumn()),
        'finicio'=>$this->string(19)->append($this->collateColumn()),
         'ftermino'=>$this->string(19)->append($this->collateColumn()),
        'fingreso'=>$this->char(10)->append($this->collateColumn()),
        'detalles'=>$this->text()->append($this->collateColumn()),
         'codaula'=>$this->string(10)->append($this->collateColumn()),
          'duracion'=>$this->integer(3)->notNull(),
         
        ],$this->collateTable());
  
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNO,'codalu');*/
     $this->addForeignKey($this->generateNameFk($table), $table,
              'talleres_id', static::NAME_TABLE_TALLERES,'id');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'talleresdet_id', static::NAME_TABLE_TALLERESDET,'id');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codtra', static::NAME_TABLE_TRABAJADORES,'codigotra');
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