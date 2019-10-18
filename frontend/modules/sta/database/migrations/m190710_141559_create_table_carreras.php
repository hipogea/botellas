<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
/**
 * Class m190710_141559_create_table_carreras
 */
class m190710_141559_create_table_carreras extends baseMigration
{
     const NAME_TABLE='{{%sta_carreras}}';
     const NAME_TABLE_FACULTADES='{{%sta_facultades}}';
 //const NAME_TABLE_DOCBOTELLAS='{{%bigitems_docbotellas}}';
  //const NAME_TABLE_ACTIVOS='{{%activos}}';
//const NAME_TABLE_UM='{{%ums}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
              'codcar'=>$this->string(6)->append($this->collateColumn()),
             'codfac'=>$this->string(8)->notNull()->append($this->collateColumn()),
            'descar' => $this->string(60)->notNull()->append($this->collateColumn()),//id padre
         'code1' => $this->char(2),//id padre
        'code2' => $this->char(2),//id padre
        'code3' => $this->char(3),//id padre
        ],$this->collateTable());
             $this->addPrimaryKey('pk_carea',$table, 'codcar');
      $this->addForeignKey($this->generateNameFk($table), $table,
              'codfac', self::NAME_TABLE_FACULTADES,'codfac'); 
              
            }
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
       if($this->existsTable($table)) {
            $this->dropTable($table);
        }

    }

}
