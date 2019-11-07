<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;

/**
 * Class m191031_195027_create_table_examenes
 */
class m191031_195027_create_table_edificios extends baseMigration
{
    const NAME_TABLE='{{%sigi_edificios}}';
     const NAME_TABLE_CENTROS='{{%centros}}';
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
        'codtra'=>$this->string(6)->notNull()->append($this->collateColumn()),
        'nombre'=>$this->string(60)->notNull()->append($this->collateColumn()),
        'latitud'=>$this->string(16)->notNull()->append($this->collateColumn()),
        'meridiano'=>$this->string(16)->notNull()->append($this->collateColumn()),
        'proyectista'=>$this->string(60)->append($this->collateColumn()),
         'tipo'=>$this->char(3)->notNull()->append($this->collateColumn()),
        'npisos'=>$this->integer(2)->notNull(),
         'detalles'=>$this->text()->append($this->collateColumn()),
         'codcen'=>$this->string(5)->notNull()->append($this->collateColumn()),
        'direccion'=>$this->string(100)->notNull()->append($this->collateColumn()),
        'coddepa'=>$this->char(3)->notNull()->append($this->collateColumn()),
        'codprov'=>$this->char(6)->notNull()->append($this->collateColumn()),
        //'coddepa'=>$this->char(9)->notNull()->append($this->collateColumn()),
'coddist'=>$this->char(9)->notNull()->append($this->collateColumn())         
                
        ],$this->collateTable());
  
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNO,'codalu');*/
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codcen', static::NAME_TABLE_CENTROS,'codcen');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codtra', static::NAME_TABLE_TRABAJADORES,'codigotra');
                /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codcar', static::NAME_TABLE_CARRERAS,'codcar');*/
             $this->putCombo($table, 'tipo',[
                 'CONDOMINIO',
                 'CENTRO COMERCIAL',
                 'CLUB ESPARCIMIENTO',
                 'CENTRO EMPRESARIAL',
                 'HOTEL'
             ]);
            } 
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
     
       if($this->existsTable($table)) {
           $this->deleteCombo($table, 'tipo');
            $this->dropTable($table);
        }
     

    }

}