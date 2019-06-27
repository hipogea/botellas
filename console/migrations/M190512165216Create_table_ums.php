<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190512165216Create_table_ums
 */
class M190512165216Create_table_ums extends baseMigration
{
   const NAME_TABLE='{{%ums}}';
   
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
if(!$this->existsTable(static::NAME_TABLE)) {
        $this->createTable(static::NAME_TABLE, [
            'codum'=>$this->string(4)->append($this->collateColumn()),            
             'desum'=>$this->string(14)->append($this->collateColumn()),
             'dimension'=>$this->char(1)->append($this->collateColumn()),
            'escala'=>$this->integer(20),
            //'codigoitem'=>$this->string($this->specialSizeFor('codigoitem'))->append($this->collateColumn()), 
            //'escontenedor'=>$this->char(1)->append($this->collateColumn())
            ],
                $this->collateTable());
        $this->addPrimaryKey($this->generateNameFk(static::NAME_TABLE),static::NAME_TABLE, 'codum');
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
