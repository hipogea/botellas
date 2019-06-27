<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190512033441Create_table_profile
 */
class M190512033441Create_table_profile extends  baseMigration
{
    /**
     * {@inheritdoc}
     */
    const NAME_TABlE='{{%profile}}';
    const NAME_TABlE_USER='{{%user}}';
    public function safeUp()
    {
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable(static::NAME_TABlE)) {
       $this->createTable(static::NAME_TABlE, [
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(11),
            'duration'=>$this->integer(11),
             'durationabsolute'=>$this->integer(11),
            'names' => $this->string(60)->append($this->collateColumn()),
            'photo' => $this->text()->append($this->collateColumn()),
            'detalle'=>$this->text()->append($this->collateColumn()),
            
            ],
           $this->collateTable());
       $this->addForeignKey($this->generateNameFk(static::NAME_TABlE), static::NAME_TABlE,
              'user_id', static::NAME_TABlE_USER,'id');
       
        }
        
         
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
   if ($this->db->schema->getTableSchema(static::NAME_TABlE, true) !== null) {
            $this->dropTable(static::NAME_TABlE);
        }
    }

   
}
