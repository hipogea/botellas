<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190516160950Create_tablw_params_centros
 */
class M190516160950Create_tablw_params_centros extends  baseMigration
{

 const NAME_TABLE='{{%centrosparametros}}';
 const NAME_TABLE_CENTROS='{{%centros}}';
 const NAME_TABLE_PARAMETROS='{{%parametros}}';
    public function safeUp()
    {
       
 if(!$this->existsTable(static::NAME_TABLE)) {
        $this->createTable(static::NAME_TABLE, [
             'id'=>$this->primaryKey(),
            'codparam'=>$this->char(5)->append($this->collateColumn()), //define si es venta o compra
            'codcen' => $this->string(5)->append($this->collateColumn()),
             'valor' => $this->string(60)->append($this->collateColumn()), 
            'valor1' => $this->string(3)->append($this->collateColumn()), 
            'valor2' => $this->string(3)->append($this->collateColumn()), 
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codcen', static::NAME_TABLE_CENTROS,'codcen');
          $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codparam', static::NAME_TABLE_PARAMETROS,'codparam');
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
