<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


class m191006_193745_create_table_tallerpsico extends baseMigration
{
   
     const NAME_TABLE='{{%sta_tallerpsico}}';
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
        'talleres_id'=>$this->integer(11)->notNull(),/*
        'codtra'=>$this->string(14)->notNull()->append($this->collateColumn()),
        'fingreso'=>$this->char(10)->append($this->collateColumn()),
        'detalles'=>$this->text()->append($this->collateColumn()),
        */
          'nalumnos'=>$this->integer(3),
         'fregistro'=>$this->char(10)->notNull()->append($this->collateColumn()),
        'codtra'=>$this->string(6)->notNull()->append($this->collateColumn()),
        'calificacion'=>$this->char(1)->append($this->collateColumn()),
         
        ],$this->collateTable());
  
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNO,'codalu');*/
    $this->addForeignKey($this->generateNameFk($table), $table,
              'talleres_id', static::NAME_TABLE_TALLERES,'id');
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