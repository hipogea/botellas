<?php

namespace console\migrations;

use console\migrations\baseMigration;
class M190508053799FillTableClipro extends baseMigration
{
    const NAME_TABLE='{{%clipro}}';
 //const NAME_TABLE_CENTROS='{{%centros}}';
    public function safeUp()
    {
            \Yii::$app->db->createCommand()->
             batchInsert(static::NAME_TABLE,
             $this->fields(), $this->getData())->execute();
    }

    public function safeDown()
    { static::deleteData();
    }

    
    private static function  getData(){
              return [
['100000','EMPRESA PERSONA NATURAL','10000000000']
           ];      
            
    }
    
    private static function  fields(){
        return ['codpro','despro','rucpro'];
    }
    
    private static function  deleteData(){        
        
          (new \yii\db\Query)
    ->createCommand()
    ->delete(self::NAME_TABLE)
    ->execute();
       
    }
}