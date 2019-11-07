<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\viewMigration;
use frontend\modules\sta\models\Alumnos;
use frontend\modules\sta\models\Aluriesgo;
use frontend\modules\sta\models\Materias;
use frontend\modules\sta\models\Cursos;
use common\helpers\FileHelper;
use console\migrations\baseMigration;
class m191013_162190_create_table_rangos  extends baseMigration
{
 const NAME_TABLE='{{%sta_rangos}}';
     const NAME_TABLE_TALLERES='{{%sta_talleres}}';
    // const NAME_TABLE_TRABAJADORES='{{%trabajadores}}';
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
        'talleres_id'=>$this->integer(11)->notNull(),
        'dia'=>$this->integer(1)->notNull(),
        'hinicio'=>$this->char(5)->notNull()->append($this->collateColumn()),
        'hfin'=>$this->char(5)->notNull()->append($this->collateColumn()),
        'tolerancia'=>$this->decimal(4,1)->notNull(),
       'activo'=>$this->char(1)->notNull()->append($this->collateColumn()),
        ],$this->collateTable());
  
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNO,'codalu');*/
    $this->addForeignKey($this->generateNameFk($table), $table,
              'talleres_id', static::NAME_TABLE_TALLERES,'id');
    /*$this->addForeignKey($this->generateNameFk($table), $table,
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