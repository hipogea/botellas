<?php
namespace frontend\modules\bigitems\database\migrations;

use console\migrations\baseMigration;

/**
 * Class m190406_230040_create_table_items
 */
class m190406_230040_create_table_items extends baseMigration
{
     const NAME_TABLE='{{%activos}}';
     const NAME_TABLE_PLACES='{{%lugares}}';
     const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
 
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
$table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
 $this->createTable($table, [
            'id'=>$this->primaryKey(),
             'codigo'=>$this->string(16)->append($this->collateColumn()),
            'codigo2'=>$this->string(16)->append($this->collateColumn()),
            'codigo3'=>$this->string(16)->append($this->collateColumn()),
     'codmaterial'=>$this->string(16)->append($this->collateColumn()),
            'descripcion'=>$this->string(40)->append($this->collateColumn()),
            'marca'=>$this->string(30)->append($this->collateColumn()),
            'modelo'=>$this->string(30)->append($this->collateColumn()),
            'serie'=>$this->string(40)->append($this->collateColumn()),
            'anofabricacion'=>$this->char(4)->append($this->collateColumn()),
             'codigoitem'=>$this->string(14)->append($this->collateColumn()), 
      'codigocontable'=>$this->string(20)->append($this->collateColumn()), 
      'espadre'=>$this->string(20)->append($this->collateColumn()), 
     'lugar_original_id'=>$this->integer(11), //luar origen al cual pertenece
       'tipo'=>$this->char(2)->append($this->collateColumn()),
     'codarea'=>$this->char(3)->append($this->collateColumn()),
     
     /*campos que cambian conel tiempo*/ 
    'codestado'=>$this->char(2)->append($this->collateColumn()),
     'lugar_id'=>$this->integer(11), //identiifacion del lugar
      'direccion_id'=>$this->integer(11), //identiifacion del lugar
     'direccion_original_id'=>$this->integer(11), //identiifacion del lugar
     'fecha'=>$this->char(10)->append($this->collateColumn()),//
     'codocu'=>$this->char()->append($this->collateColumn()),
     'numdoc'=>$this->string(20)->append($this->collateColumn()),
     'entransporte'=>$this->char(3)->append($this->collateColumn())],
                $this->collateTable());
// var_dump($this->generateNameFk(static::NAME_TABLE));die();
     $this->addForeignKey($this->generateNameFk($table), $table,
              'lugar_original_id', self::NAME_TABLE_PLACES,'id');
     $this->addForeignKey($this->generateNameFk($table), $table,
              'lugar_id', self::NAME_TABLE_PLACES,'id');
     $this->addForeignKey($this->generateNameFk($table), $table,
              'codocu', self::NAME_TABLE_DOCUMENTOS,'codocu');
        $this->createIndex('index_1co3digo', $table, 
                'codigo', true);
         $this->createIndex('index_2c4odigo2', $table, 
                'codigo2', true);
         $this->createIndex('index_3c5od4igo3', $table, 
                'codigo3', true);
    $this->putCombo($table, 'tipo', 'MAQUINARIA');
     $this->putCombo($table, 'codarea', 'MANTENIMIENTO');
     $this->putCombo($table, 'codestado', 'OPERATIVO');
    }

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
          /// $this->dropForeignKey('fk_actos_pls_ORIG',static::NAME_TABLE);
           // $this->dropForeignKey('fk_acos_pces',static::NAME_TABLE);
           //$this->dropForeignKey('fk_acts_docu45os',static::NAME_TABLE);
            $this->dropTable(static::NAME_TABLE);
        }

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_230040_create_table_items cannot be reverted.\n";

        return false;
    }
    */
}
