<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;

class m191101_164027_create_table_sumnisitros extends baseMigration
{
    const NAME_TABLE='{{%sigi_suministros}}';
     const NAME_TABLE_UMS='{{%ums}}';
     const NAME_TABLE_CLIPRO='{{%clipro}}';
     const NAME_TABLE_UNIDADES='{{%sigi_unidades}}';
   //const NAME_TABLE_ALUMNO='{{%sta_alu}}';
    /*const NAME_TABLE_CURSOS='{{%sta_materias}}';
     const NAME_TABLE_PERIODOS='{{%sta_periodos}}';*/
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
        'tipo'=>$this->char(3)->notNull()->append($this->collateColumn()),
        //'codmon'=>$this->string(5)->notNull()->append($this->collateColumn()),
        'codpro'=>$this->string(6)->notNull()->append($this->collateColumn()),
        'codsuministro'=>$this->string(12)->append($this->collateColumn()),
        'numerocliente'=>$this->string(25)->append($this->collateColumn()),
        'codum'=>$this->string(4)->notNull(),
        'unidad_id'=>$this->integer(11)->notNull(),
        'detalles'=>$this->text()->append($this->collateColumn()),
        'frecuencia'=>$this->integer(5),
       // 'indicaciones2'=>$this->text()->append($this->collateColumn()),
                 
        ],$this->collateTable());
  
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codpro', static::NAME_TABLE_CLIPRO,'codpro');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codum', static::NAME_TABLE_UMS,'codum');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'unidad_id', static::NAME_TABLE_UNIDADES,'id');
  
        $this->putCombo($table,'tipo', [
            'ENERGIA ELECTRICA',
            'AGUA POTABLE',
            'GAS',
            'TELEVISION DIGITAL',
           // 'TELEFONIA',
            'SERVICIO DE INTERNET Y TELEFONIA'
        ]);    
            } 
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
    
       if($this->existsTable($table)) {
            $this->deleteCombo($table, 'tipo');
            $this->dropTable($table);
        }


    }

}