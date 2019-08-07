<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190512165349Create_table_maestrocompo
 */
class M190512165349Create_table_maestrocompo extends baseMigration
{
   const NAME_TABLE='{{%maestrocompo}}';
   const NAME_TABLE_UM='{{%ums}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
        $this->createTable(static::NAME_TABLE, [
            'id'=>$this->primaryKey(),
            'codart'=>$this->string(14)->unique()->notNull()->append($this->collateColumn()),
            //'codigo'=>$this->string(10)->append($this->collateColumn()),
            'descripcion'=>$this->string(60)->notNull()->append($this->collateColumn()),
            'marca'=>$this->string(30)->append($this->collateColumn()),
            'modelo'=>$this->string(30)->append($this->collateColumn()),
            'numeroparte'=>$this->string(30)->append($this->collateColumn()),
              'codum'=>$this->string(4)->append($this->collateColumn()),
             'peso'=>$this->string(4)->append($this->collateColumn()),
             'codtipo'=>$this->char(3)->append($this->collateColumn()),
            'esrotativo'=>$this->char(1)->append($this->collateColumn()),
             'codean'=>$this->string(14)->append($this->collateColumn()),
             'codosce'=>$this->string(18)->append($this->collateColumn()),
              'cod1'=>$this->string(10)->append($this->collateColumn()),
             'cod2'=>$this->string(10)->append($this->collateColumn()),
             'codunsc'=>$this->string(16)->append($this->collateColumn()),
            //'codigoitem'=>$this->string($this->specialSizeFor('codigoitem'))->append($this->collateColumn()), 
            //'escontenedor'=>$this->char(1)->append($this->collateColumn())
            ],
                $this->collateTable());
        $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codum',static::NAME_TABLE_UM,'codum');
        $this->putCombo($table, 'codtipo', 'MAQUINARIA');
        
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
