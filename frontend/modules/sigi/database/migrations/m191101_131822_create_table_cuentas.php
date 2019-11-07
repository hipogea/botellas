<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m191101_131822_create_table_cuentas extends baseMigration
{
    const NAME_TABLE='{{%sigi_cuentas}}';
     const NAME_TABLE_BANCOS='{{%bancos}}';
     const NAME_TABLE_CLIPRO='{{%clipro}}';
     const NAME_TABLE_EDIFICIOS='{{%sigi_edificios}}';
      const NAME_TABLE_MONEDAS='{{%monedas}}';
   //const NAME_TABLE_ALUMNO='{{%sta_alu}}';
    /*const NAME_TABLE_CURSOS='{{%sta_materias}}';
     const NAME_TABLE_PERIODOS='{{%sta_periodos}}';*/
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
        'tipo'=>$this->char(3)->notNull()->append($this->collateColumn()),
        'codmon'=>$this->string(5)->notNull()->append($this->collateColumn()),
        'codpro'=>$this->char(6)->notNull()->append($this->collateColumn()),
        'nombre'=>$this->string(60)->notNull()->append($this->collateColumn()),
        'numero'=>$this->string(100)->notNull()->append($this->collateColumn()),
        'banco_id'=>$this->integer(11)->notNull(),
        'edificio_id'=>$this->integer(11)->notNull(),
        'detalles'=>$this->text()->append($this->collateColumn()),
        'indicaciones'=>$this->text()->append($this->collateColumn()),
        'indicaciones2'=>$this->text()->append($this->collateColumn()),
                 
        ],$this->collateTable());

    $this->addForeignKey($this->generateNameFk($table), $table,
              'codmon', static::NAME_TABLE_MONEDAS,'codmon');
   /* $this->addForeignKey($this->generateNameFk($table), $table,
              'codpro', static::NAME_TABLE_CLIPRO,'codro');*/
    $this->addForeignKey($this->generateNameFk($table), $table,
              'banco_id', static::NAME_TABLE_BANCOS,'id');
      $this->addForeignKey($this->generateNameFk($table), $table,
              'edificio_id', static::NAME_TABLE_EDIFICIOS,'id');
            
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