<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;



/**
 * Class m190730_053134_create_table_aulas
 */
class m190730_053134_create_table_aulas  extends baseMigration
{
     const NAME_TABLE='{{%sta_aulas}}';
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
               'codaula'=>$this->string(12)->append($this->collateColumn()),
         // 'profile_id'=>$this->integer(11)->notNull(),
              'codfac'=>$this->string(6)->append($this->collateColumn()),
             'pabellon'=>$this->string(40)->append($this->collateColumn()),
        'cap'=>$this->integer(3),
         
            //'dni' => $this->string(12)->append($this->collateColumn()),
//'domicilio'=>$this->string(80)->append($this->collateColumn()),

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