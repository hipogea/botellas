<?php
namespace frontend\modules\bigitems\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
/**
 * Class m190630_143815_create_table_docbotellas
 */
class m190630_150843_create_table_detdocbotellas extends baseMigration
{
     const NAME_TABLE='{{%bigitems_detdocbotellas}}';
 const NAME_TABLE_DOCBOTELLAS='{{%bigitems_docbotellas}}';
  const NAME_TABLE_ACTIVOS='{{%activos}}';
//const NAME_TABLE_UM='{{%ums}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'doc_id' => $this->integer(11)->notNull(),//id padre
               'codigo' => $this->string(16)->notNull(),//codigo activo
        'tarifa' => $this->double(),//
        'codocuref'=>$this->char(3)->append($this->collateColumn()),//Documento de referencia
         'numdocuref'=>$this->string(16)->append($this->collateColumn()),//Documento de referencia
        'detalle'=>$this->text()->append($this->collateColumn()),        
        'codestado' => $this->char(2)->notNull()->append($this->collateColumn()),
           'coditem' => $this->char(3)->notNull()->append($this->collateColumn()),
        
        ],$this->collateTable());
             
                $this->addForeignKey($this->generateNameFk($table), $table,
              'doc_id', static::NAME_TABLE_DOCBOTELLAS,'id');
                  $this->addForeignKey($this->generateNameFk($table), $table,
              'codigo', static::NAME_TABLE_ACTIVOS,'codigo');
  
         $this->putCombo($table, 'codestado', 'CREADO');
                  
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
