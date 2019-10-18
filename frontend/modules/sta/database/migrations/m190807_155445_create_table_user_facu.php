<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;



/**
 * Class m190807_155445_create_table_user_facu
 */
class m190807_155445_create_table_user_facu extends baseMigration
{
     const NAME_TABLE='{{%sta_user_facultades}}';
    /// const NAME_TABLE_CARRERAS='{{%sta_carreras}}';
     const NAME_TABLE_FACU='{{%sta_facultades}}';
 //const NAME_TABLE_DOCBOTELLAS='{{%bigitems_docbotellas}}';
  //const NAME_TABLE_ACTIVOS='{{%activos}}';
//const NAME_TABLE_UM='{{%ums}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
               'id'=>$this->primaryKey(),
               'user_id'=>$this->integer(4),
         // 'profile_id'=>$this->integer(11)->notNull(),
              'codfac'=>$this->string(8)->append($this->collateColumn()),
             'activa'=>$this->char(1)->append($this->collateColumn()),
       
        ],$this->collateTable());
          $this->addForeignKey($this->generateNameFk($table), $table,
              'codfac', static::NAME_TABLE_FACU,'codfac');
                /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codcar', static::NAME_TABLE_CARRERAS,'codcar');*/
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