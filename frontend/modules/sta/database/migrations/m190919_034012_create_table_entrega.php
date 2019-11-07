<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;


/**
 * */
class m190919_034012_create_table_entrega extends baseMigration
{
     const NAME_TABLE='{{%sta_entregas}}';
   const NAME_TABLE_PERIODOS='{{%sta_periodos}}';
    // const NAME_TABLE_MATERIAS='{{%sta_materias}}';
       const NAME_TABLE_ALUMNOS='{{%sta_alu}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
        'descripcion'=>$this->string(40)->append($this->collateColumn())->notNull(),
        
         // 'codfac'=>$this->string(8)->append($this->collateColumn())->notNull(),
          'fecha'=>$this->char(10)->append($this->collateColumn())->notNull(),
         'fechacorte'=>$this->char(10)->append($this->collateColumn())->notNull(),
        'version'=>$this->char(1)->append($this->collateColumn()),
         'comentario'=>$this->text()->append($this->collateColumn()),
          //'activa'=>$this->char(1)->append($this->collateColumn()),
         'codperiodo'=>$this->string(6)->append($this->collateColumn())->notNull(),
         'detalles'=>$this->text()->append($this->collateColumn()),
        'codocu'=>$this->char(3)->append($this->collateColumn()),
        'numero'=>$this->string(8)->append($this->collateColumn()),
         //'electivo'=>$this->char(1)->append($this->collateColumn()),
         //'ciclo'=>$this->integer(2),
        //'version'=>$this->char(1)->append($this->collateColumn()),
       'tienecabecera'=>$this->char(1)->append($this->collateColumn()),
        'modelo'=>$this->string(180)->notNull()->append($this->collateColumn()),
         'escenario'=>$this->string(40)->notNull()->append($this->collateColumn()),
         'cargamasiva_id'=>$this->integer(11),
       
        ],$this->collateTable());
   //$this->addPrimaryKey('pk_codmateria',$table, 'codcur');
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codfac', static::NAME_TABLE_FACU,'codfac');*/
       
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