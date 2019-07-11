<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m190710_172038_create_table_alu extends baseMigration
{
     const NAME_TABLE='{{%sta_alu}}';
     const NAME_TABLE_CARRERAS='{{%sta_carreras}}';
     const NAME_TABLE_PROFILE='{{%profile}}';
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
          'profile_id'=>$this->integer(11)->notNull(),
              'codcar'=>$this->string(6)->append($this->collateColumn()),
             'ap'=>$this->string(40)->append($this->collateColumn()),
        'am'=>$this->string(40)->append($this->collateColumn()),
         'nombres'=>$this->string(40)->append($this->collateColumn()),
        'fecna'=>$this->string(10)->append($this->collateColumn()),
        'codalu'=>$this->string(14)->append($this->collateColumn()),
            'dni' => $this->string(12)->append($this->collateColumn()),
'domicilio'=>$this->string(80)->append($this->collateColumn()),
        'codist'=>$this->string(3)->append($this->collateColumn()),
        'codprov'=>$this->string(3)->append($this->collateColumn()),
        'codep'=>$this->string(3)->append($this->collateColumn()),
         'sexo'=>$this->char(1)->append($this->collateColumn()),
        ],$this->collateTable());
          $this->addForeignKey($this->generateNameFk($table), $table,
              'profile_id', static::NAME_TABLE_PROFILE,'id');
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
