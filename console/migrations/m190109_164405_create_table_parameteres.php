<?php
namespace console\migrations;
use console\migrations\baseMigration;

/**
 * Class m190109_164405_create_table_parameteres
 */
class m190109_164405_create_table_parameteres extends baseMigration
{

    const NAME_TABLE='{{%parametros}}';
    //const NAME_TABLE_SOCIEDADES='{{%sociedades}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        

if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
            'codparam' => $this->char(5)->notNull()->append($this->collateColumn()),
            'desparam' => $this->string(60)->notNull()->append($this->collateColumn()), 
             'flag' => $this->char(1)->append($this->collateColumn()), 
            
            'explicacion'=>$this->text()->append($this->collateColumn()), 
            'tipodato'=>$this->char(1)->notNull()->append($this->collateColumn()),
            'longitud' => $this->integer(4),
             'activo'=>$this->char(1)->notNull()->append($this->collateColumn()),
             ], $this->collateTable());
       $this->addPrimaryKey('pk_parametros4t45',static::NAME_TABLE, 'codparam');     
       
        $this->batchInsert(static::NAME_TABLE,
                ['codparam','desparam','flag','explicacion','tipodato','longitud','activo'],
                $this->getRows()
                );
        
        
        
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

    }

    public function down()
    {
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
    
    private function getRows(){
        return [
            ['10000','Allow activate Orders without approbe','',
               'Permite generar ordenes de compra y las habilkita autoamticamente, no necesita aprobacion ',
             '1',1,'1'],
            ['10001','Max days for wait a approbe','1',
               'Numero de dias maximo que puede esperar un domcuento para aprobacion ante sd eser deshechado ',
             'N',4,'1'],
            
            ['10003','Allow transport without approbe','1',
               'Si se puede tranpsorar sin apobacion',
             'C',1,'1'],
            ['10002','Tamaño maximo de archivo KB','1',
               'Tamaño de un archivo maximo ',
             'N',8,'1'],
            ['10004','Ancho de imagen (Px) ','1',
               '',
             'N',8,'1'],
            ['10005','Alto de imagen (Px) ','1',
               'Si se puede comprar sin apobacion',
             'N',8,'1'],
            ['10006','Allow  without approbe','1',
               'Si se puede comprar sin apobacion',
             'C',1,'1'],
            ['10007','Allow  without approbe','1',
               'Si se puede comprar sin apobacion',
             'C',1,'1'],
            ['10008','Allow  without approbe','1',
               'Si se puede comprar sin apobacion',
             'C',1,'1']
        ];
    }
    
}
