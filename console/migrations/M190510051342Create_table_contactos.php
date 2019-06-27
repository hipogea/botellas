<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190510051342Create_table_contactos
 */
class M190510051342Create_table_contactos extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const NAME_TABlE='{{%contactos}}';
    const NAME_TABlE_CLIPRO='{{%clipro}}';
    public function safeUp()
    {
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable(static::NAME_TABlE)) {
       $this->createTable(static::NAME_TABlE, [
            'id'=>$this->primaryKey(),
            'nombres'=>$this->string(60)->append($this->collateColumn()),  
               'moviles'=>$this->string(30)->append($this->collateColumn()),
            'mail'=>$this->string(25)->append($this->collateColumn()),  
               'mail1'=>$this->string(30)->append($this->collateColumn()),
             'codpro'=>$this->char(6)->append($this->collateColumn()),
            'fenac'=>$this->char(5)->append($this->collateColumn()),
            /// 'latitud'=>$this->string(15)->append($this->collateColumn()),
            // 'meridiano'=>$this->string(15)->append($this->collateColumn()),],
               
            ],
           $this->collateTable());
       
       $this->addForeignKey($this->generateNameFk(static::NAME_TABlE), static::NAME_TABlE,
              'codpro', static::NAME_TABlE_CLIPRO,'codpro');
       
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
