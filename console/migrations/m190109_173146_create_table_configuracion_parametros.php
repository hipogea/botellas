<?php
namespace console\migrations;
use console\migrations\baseMigration;


/**
 * Class m190109_173146_create_table_configuracion_parametros
 */
class m190109_173146_create_table_configuracion_parametros extends baseMigration
{
    
 const NAME_TABLE='{{%configuracion}}';
 const NAME_TABLE_CENTROS='{{%centros}}';
  const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
  const NAME_TABLE_PARAMETROS='{{%parametros}}';
 //const FKCENTROS='fk_configuracion_centros';
  //const FKDOCUMENTOS='fk_configuracion_documentos';
 // const FKPARAMETROS='fk_configuracion_parametros';
  public $fkcentros;
  public $fkdocumentos;
  public $fkparametros;
  
  
  
    public function safeUp()
            
    {  
        
        
     
if(!$this->existsTable(static::NAME_TABLE)) {
   // $this->assignFks();   
        $this->createTable(static::NAME_TABLE, [
            'id'=>$this->primaryKey(),
            'codcen'=>$this->string(5)->append($this->collateColumn()),
           'codocu' => $this->char(3)->notNull()->append($this->collateColumn()),
            'codparam' => $this->char(5)->notNull()->append($this->collateColumn()),
            'valor'=>$this->text()->append($this->collateColumn()),
            ],$this->collateTable());
        $this->alterColumn(static::NAME_TABLE, 'id', $this->bigInteger(11).' NOT NULL AUTO_INCREMENT');
       $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codcen', self::NAME_TABLE_CENTROS,'codcen');
        
        $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codocu', self::NAME_TABLE_DOCUMENTOS,'codocu');
        
        /*$this->addForeignKey($this->fkparametros, static::NAME_TABLE,
              'codparam', self::NAME_TABLE_PARAMETROS,'codparam');*/
        }
        
        
        
       }
    
    
    
    
    
    

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $this->dropFks(static::NAME_TABLE);
        if ($this->existsTable(static::NAME_TABLE)) {
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
        echo "m190106_053758_create_table_documents cannot be reverted.\n";

        return false;
    }
    */
}
