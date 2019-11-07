<?php

namespace console\migrations;

use console\migrations\baseMigration;
class M191101132100FillTableMonedas extends baseMigration
{
    const NAME_TABLE='{{%monedas}}';
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
['PEN','NUEVO SOL','1','S/.'],
['USD','DOLAR AMERICANO','1','$/.'],
           ];      
            
    }
    
    private static function  fields(){
        return ['codmon','desmon','activa','simbolo'];
    }
    
    private static function  deleteData(){        
        
          (new \yii\db\Query)
    ->createCommand()
    ->delete(self::NAME_TABLE)
    ->execute();
       
    }
}