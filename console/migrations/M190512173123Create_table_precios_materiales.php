<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190512173123Create_table_precios_materiales
 */
class M190512173123Create_table_precios_materiales extends baseMigration
{

 const NAME_TABLE='{{%maestroclipro}}';
  const NAME_TABLE_CLIPRO='{{%clipro}}';
   const NAME_TABLE_MAESTRO='{{%maestrocompo}}';
    public function safeUp()
    {
       
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
             'id'=>$this->primaryKey(),
            'venta'=>$this->char(1)->append($this->collateColumn()), //define si es venta o compra
            'codpro' => $this->char(6)->append($this->collateColumn()),
            'codart' => $this->string(14)->append($this->collateColumn()),
            'vencimiento' => $this->integer(),
            'tiempoentrega'=>$this->integer(),
              'codcen' =>$this->string(5)->append($this->collateColumn()),
            'precio'=>$this->double(3),
            'codmon' => $this->string(4)->append($this->collateColumn()),
            'param1' => $this->char(2)->append($this->collateColumn()),
            'param2' => $this->char(2)->append($this->collateColumn()),
             'param3' => $this->char(1)->append($this->collateColumn()),
            'param4' => $this->string(10)->append($this->collateColumn()),
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codpro', static::NAME_TABLE_CLIPRO,'codpro');
         $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codart',static::NAME_TABLE_MAESTRO,'codart');
      
}
    
    }

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
            $this->dropTable(static::NAME_TABLE);
        }

    }
}
