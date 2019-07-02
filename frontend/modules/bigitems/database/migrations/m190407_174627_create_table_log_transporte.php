<?php
namespace frontend\modules\bigitems\database\migrations;

use console\migrations\baseMigration;

/**
 * Class m190407_174627_create_table_log_transporte
 */
class m190407_174627_create_table_log_transporte extends baseMigration
{
    const NAME_TABLE='{{%logtransporte}}';
     const NAME_TABLE_ASSETS='{{%activos}}';
     const NAME_TABLE_PLACES='{{%lugares}}';
     //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
   
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

if(!$this->existsTable(static::NAME_TABLE)) {
 $this->createTable(static::NAME_TABLE, [
            'id'=>$this->primaryKey(),
            'activo_id'=>$this->integer(11),
     /*campos reflejo de la tabla activos*/
     'codestado'=>$this->char(2)->append($this->collateColumn()),
     'lugar_id'=>$this->integer(11), //identiifacion del lugar
     'lugar_original_id'=>$this->integer(11), //identiifacion del lugar
     'direccion_id'=>$this->integer(11), //identiifacion del lugar
     'direccion_original_id'=>$this->integer(11), //identiifacion del lugar
      'fecha'=>$this->char(10)->append($this->collateColumn()),//
     'fechadoc'=>$this->char(10)->append($this->collateColumn()),//
     'codocu'=>$this->char(3)->append($this->collateColumn()),
     'numdoc'=>$this->string(20)->append($this->collateColumn()),
     /*Fin de campos reflejos de la tabla activos */
     'lugar_anterior_id'=>$this->integer(11), //lugar inmediato anterior
      'direccion_anterior_id'=>$this->integer(11), //lugar inmediato anterior
     'time'=>$this->char(18)->append($this->collateColumn()),
     'user_id'=>$this->integer(11)],
                $this->collateTable());
 $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'activo_id', self::NAME_TABLE_ASSETS,'id');
     $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'lugar_id', self::NAME_TABLE_PLACES,'id');
     $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'lugar_anterior_id', self::NAME_TABLE_PLACES,'id');
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }*/

    
}
