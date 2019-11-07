<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m191106_024620_create_table_grupo_presup extends baseMigration
{
   const NAME_TABLE='{{%sigi_grupo_presupuesto}}';
    // const NAME_TABLE_UNIDADES='{{%sigi_unidades}}';
   
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'codigo'=>$this->char(4)->notNull()->append($this->collateColumn()),
        'descripcion'=>$this->string(70)->append($this->collateColumn()),
         'detalle'=>$this->text()->append($this->collateColumn()),
        'tipo'=>$this->char(2)->notNull()->append($this->collateColumn()),
        ],$this->collateTable());
  $this->addPrimaryKey($this->generateNameFk($table), $table, 'codigo');
  $this->putCombo($table,'tipo', [
                            'Administracion',
                            'Operaciones',
                            'Mantenimiento',
                            'Servicios'
                                ]);
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