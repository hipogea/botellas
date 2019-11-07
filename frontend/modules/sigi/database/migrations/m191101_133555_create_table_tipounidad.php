<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
class m191101_133555_create_table_tipounidad extends  baseMigration
{
    const NAME_TABLE='{{%sigi_tipounidad}}';
     /*const NAME_TABLE_BANCOS='{{%bancos}}';
     const NAME_TABLE_CLIPRO='{{%clipro}}';
     const NAME_TABLE_EDIFICIOS='{{%sigi_edificios}}';
   //const NAME_TABLE_ALUMNO='{{%sta_alu}}';
    /*const NAME_TABLE_CURSOS='{{%sta_materias}}';
     const NAME_TABLE_PERIODOS='{{%sta_periodos}}';*/
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
        'codtipo'=>$this->char(4)->notNull()->append($this->collateColumn()),
        'desunidad'=>$this->string(40)->notNull()->append($this->collateColumn()),
        'escomun'=>$this->char(1)->notNull()->append($this->collateColumn())
        ],$this->collateTable());
            
          
   $this->addPrimaryKey($this->generateNameFk($table),
                $table,'codtipo');
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