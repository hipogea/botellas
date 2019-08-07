<?php
namespace console\migrations;
use console\migrations\baseMigration;

/**
 * Class M190805024634CreateTablaAlmacenes
 */
class M190805024634CreateTablaAlmacenes extends baseMigration
{
    const NAME_TABLE='{{%almacenes}}';
 const NAME_TABLE_CENTROS='{{%centros}}';
 //const NAME_TABLE_PARAMETROS='{{%parametros}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'codal'=>$this->char(4)->notNull()->notNull()->append($this->collateColumn()),
            'nomal'=>$this->string(25)->notNull()->append($this->collateColumn()), //define si es venta o compra
            'tipo' => $this->char(2)->notNull()->append($this->collateColumn()),
           'codcen' => $this->string(5)->notNull()->append($this->collateColumn()),
        'tipoval' => $this->char(2)->notNull()->append($this->collateColumn()), 
         'reposicionsololibre' => $this->char(1)->notNull()->append($this->collateColumn()), 
            'estructura' => $this->string(15)->append($this->collateColumn()), 
           'tipoval' => $this->char(1)->notNull()->append($this->collateColumn()),
	'novalorado' => $this->char(1)->notNull()->append($this->collateColumn()),
	'tolstockres' => $this->decimal(4,2),	
	'codmon' =>$this->char(3)->notNull()->append($this->collateColumn()),
	'agregarauto'=>$this->char(1)->notNull()->append($this->collateColumn()),
	'bloqueado'=>$this->char(1)->notNull()->append($this->collateColumn()),
        
        ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
             'codcen', static::NAME_TABLE_CENTROS,'codcen');
         $this->addPrimaryKey('pk'.$this->generateNameFk($table),static::NAME_TABLE, 'codal');
         /* $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'codparam', static::NAME_TABLE_PARAMETROS,'codparam');*/
               }
    $this->addCommentOnColumn($table,'reposicionsololibre','solo tomar encuenta el stock libre , no el reservado ni el de transito');
     $this->addCommentOnColumn($table,'tipoval','tipo valorizacion : promedio, LIFO FIFO');
     $this->addCommentOnColumn($table,'tolstockres','Toleracia de merma');
    $this->putCombo($table, 'tipo', 'INSUMOS');
     $this->putCombo($table, 'tipoval', 'VALOR PROMEDIO');
           
}

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {    $table=static::NAME_TABLE;
       if ($this->db->schema->getTableSchema($table, true) !== null) {
            $this->dropTable($table);
        }

    }
}
