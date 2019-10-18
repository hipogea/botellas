<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
/**
 * Class m190710_141035_create_table_facultades
 */
class m190710_141035_create_table_facultades extends baseMigration
{
     const NAME_TABLE='{{%sta_facultades}}';
 //const NAME_TABLE_DOCBOTELLAS='{{%bigitems_docbotellas}}';
  //const NAME_TABLE_ACTIVOS='{{%activos}}';
//const NAME_TABLE_UM='{{%ums}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'codfac'=>$this->string(8),
            'desfac' => $this->string(60)->notNull()->append($this->collateColumn()),//id padre
         'code1' => $this->char(2)->append($this->collateColumn()),//id padre
        'code2' => $this->char(2)->append($this->collateColumn()),//id padre
        'code3' => $this->char(3)->append($this->collateColumn()),//id padre
        ],$this->collateTable());
              $this->addPrimaryKey('pk_facu',$table, 'codfac');
      /*$this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codsoc', self::NAME_TABLE_SOCIEDADES,'socio'); */
              
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
