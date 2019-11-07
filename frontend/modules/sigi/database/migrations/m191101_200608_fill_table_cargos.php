<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;

class m191101_200608_fill_table_cargos extends baseMigration
{
   
  const NAME_TABLE='{{%sigi_cargos}}';
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
        //$campos=['codocu','codocupadre','desdocu','clase','tipo','abreviatura'];
        return [
            ['1000', 'MANTENIMIENTO GENERAL AACC' ,'0','1'],
            ['1001', 'CONSUMO ENERGIA ELECTRICA' ,'0','1'],
            ['1002', 'CONSUMO AGUA POTABLE' ,'0','1'],
            ['1004', 'CUOTA EXTRAORDINARIA' ,'0','0'],
            ['1005', 'MULTA POR INFRACCION' ,'0','0'],
            ['1006', 'CARGO POR MORA' ,'0','0'],
            ['1007', 'REDONDEO MES ANTERIOR' ,'0','0'],
            ['1008', 'CARGO POR REPOSICION DE DAÑOS' ,'0','0'],
            ];
    }
    
    
    private static function  fields(){
        return  ['codcargo','descargo','esegreso','regular'];
    }
    
    private static function  deleteData(){        
        
          (new \yii\db\Query)
    ->createCommand()
    ->delete(self::NAME_TABLE)
    ->execute();
       
    }
}
    
  