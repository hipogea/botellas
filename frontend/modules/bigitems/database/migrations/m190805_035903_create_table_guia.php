<?php
namespace frontend\modules\bigitems\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m190805_035903_create_table_guia extends  baseMigration
{
 
     const NAME_TABLE='{{%bigitems_guia}}';
 const NAME_TABLE_CENTROS='{{%centros}}';
  const NAME_TABLE_CLIPRO='{{%clipro}}';
  const NAME_TABLE_DIRECCIONES='{{%direcciones}}';
  const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
//const NAME_TABLE_UM='{{%ums}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
        //VAR_DUMP($this->collateColumn(), "COLLATE 'utf8_unicode_ci'");DIE();
       
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
         'numgui'=>$this->string(10)->notNull()->append($this->collateColumn()),
        'descripcion'=>$this->string(40)->append($this->collateColumn()),
             'serie'=>$this->char(3)->notNull()->append($this->collateColumn()),
           'codpro'=>$this->char(6)->notNull()->append($this->collateColumn()),
         'codpro_tran'=>$this->char(6)->notNull()->append($this->collateColumn()),
        'fecha'=>$this->char(10)->notNull()->append($this->collateColumn()),
        'fecha_tran'=>$this->char(10)->notNull()->append($this->collateColumn()),
               'codestado' => $this->char(2)->notNull()->append($this->collateColumn()),
         'chofer'=>$this->string(15)->append($this->collateColumn()),
         'codmotivo'=>$this->char(2)->notNull()->append($this->collateColumn()),
         'placa'=>$this->string(8)->append($this->collateColumn()),
        'confvehicular'=>$this->string(10)->append($this->collateColumn()),
        'brevete'=>$this->string(10)->append($this->collateColumn()),
        'ptopartida_id'=>$this->integer(11),
        'ptollegada_id'=>$this->integer(11),
       'codcen' => $this->string(5)->notNull()->append($this->collateColumn()),
        'codocu' => $this->char(3)->notNull()->append($this->collateColumn()),
          'comentario'=>$this->text()->append($this->collateColumn()),
         'essalida'=>$this->char(1)->notNull()->append($this->collateColumn()),
        ],$this->collateTable());
             
    
  	 $this->addForeignKey($this->generateNameFk($table), $table,
              'codcen', static::NAME_TABLE_CENTROS,'codcen');
                  $this->addForeignKey($this->generateNameFk($table), $table,
              'ptopartida_id', static::NAME_TABLE_DIRECCIONES,'id');
                   $this->addForeignKey($this->generateNameFk($table), $table,
              'ptollegada_id', static::NAME_TABLE_DIRECCIONES,'id');
                    $this->addForeignKey($this->generateNameFk($table), $table,
              'codpro', static::NAME_TABLE_CLIPRO,'codpro');
                    $this->addForeignKey($this->generateNameFk($table), $table,
              'codpro_tran', static::NAME_TABLE_CLIPRO,'codpro');
                    $this->addForeignKey($this->generateNameFk($table), $table,
              'codocu', static::NAME_TABLE_DOCUMENTOS,'codocu');
            }
            
             $this->putCombo($table, 'codmotivo', 'ALQUILER');
         $this->putCombo($table, 'essalida', 'INGRESO');
         $this->putCombo($table, 'codestado', 'CREADO');
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
       if($this->existsTable($table)) {
            $this->dropTable($table);
        }

    }

}
