<?php

namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m191101_183458_create_table_propietarios extends baseMigration
{
   const NAME_TABLE='{{%sigi_propietarios}}';
     const NAME_TABLE_UNIDADES='{{%sigi_unidades}}';
   
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
        'unidad_id'=>$this->integer(11)->notNull(),
        'tipo'=>$this->char(1)->notNull()->append($this->collateColumn()),
        //'codmon'=>$this->string(5)->notNull()->append($this->collateColumn()),
        'correo'=>$this->string(70)->append($this->collateColumn()),
        'correo1'=>$this->string(70)->append($this->collateColumn()),
        'correo2'=>$this->string(70)->append($this->collateColumn()),
           'celulares'=>$this->string(70)->append($this->collateColumn()),
        'fijo'=>$this->string(12)->append($this->collateColumn()),
        'dni'=>$this->string(12)->append($this->collateColumn()),
        'participacion'=>$this->decimal(6,3),        
        'detalle'=>$this->text()->append($this->collateColumn()),
        'activo'=>$this->char(1)->append($this->collateColumn()),
        'finicio'=>$this->char(10)->append($this->collateColumn()),
         'fcese'=>$this->char(10)->append($this->collateColumn()),
       // 'indicaciones2'=>$this->text()->append($this->collateColumn()),
                 
        ],$this->collateTable());
  
    $this->addForeignKey($this->generateNameFk($table), $table,
              'unidad_id', static::NAME_TABLE_UNIDADES,'id');
        
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