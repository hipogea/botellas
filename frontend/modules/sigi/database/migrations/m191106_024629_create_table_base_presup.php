<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m191106_024629_create_table_base_presup extends baseMigration
{
   const NAME_TABLE='{{%sigi_base_prespuesto}}';
   const NAME_TABLE_GRUPOS='{{%sigi_grupo_presupuesto}}';
    const NAME_TABLE_EDIFICIOS='{{%sigi_edificios}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
        'edificio_id'=>$this->integer(11)->notNull(),
        'codgrupo'=>$this->char(4)->notNull()->append($this->collateColumn()),
        'codigo'=>$this->string(10)->notNull()->append($this->collateColumn()),
        'descripcion'=>$this->string(40)->append($this->collateColumn()),
         'activo'=>$this->char(1)->append($this->collateColumn()),
        'ejercicio'=>$this->char(4)->append($this->collateColumn()),
        'mensual'=>$this->decimal(9,3)->notNull(),
        'anual'=>$this->decimal(10,3)->notNull(),
        'restringir'=>$this->char(1)->append($this->collateColumn()),
         'acumulado'=>$this->decimal(10,3)->notNull(), //Romper la normalizacion
        'detalles'=>$this->text()->append($this->collateColumn()),
        ],$this->collateTable());
  
    $this->addForeignKey($this->generateNameFk($table), $table,
              'edificio_id', static::NAME_TABLE_EDIFICIOS,'id');
      $this->addForeignKey($this->generateNameFk($table), $table,
              'codgrupo', static::NAME_TABLE_GRUPOS,'codigo');  
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