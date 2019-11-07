<?php
namespace frontend\modules\sigi\database\migrations;
//use yii\db\Migration;
use console\migrations\baseMigration;
use frontend\modules\sigi\models\Tipounidades;
class m191101_162804_fill_table_tipounidades extends baseMigration
{
    
     const NAME_TABLE='{{%sigi_tipounidad}}';
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
            ['1000', 'DEPARTAMENTO' ,'1'],
            ['1001', 'OFICINA' ,'1'], 
            ['1002', 'TIENDA' ,'1'],
            ['1003', 'CUBICULO' ,'1'], 
            ['1004', 'COCHERA' ,'1'],
            ['1005', 'DEPOSITO' ,'1'], 
            ['1006', 'LAVANDERIA' ,'0'],
            ['1007', 'JACUZZI' ,'1'], 
            ['1008', 'SALA DE RELAJACION' ,'0'],
            ['1009', 'SALA DE REUNIONES' ,'0'], 
            ['1010', 'RECEPCION' ,'0'],
            ['1011', 'PISCINA' ,'0'], 
            ['1012', 'ZONA FUMADORES' ,'0'],
            ['1013', 'OFICINA' ,'1'], 
            ['1014', 'JARDINES' ,'0'], 
            ['1015', 'GIMNASIO' ,'0'],
            ['1016', 'AZOTEA' ,'0'], 
            ['1017', 'TOPICO' ,'0'],
            ['1018', 'SALON DE CONFERENCIAS' ,'0'], 
            ];
    }
    
    
    private static function  fields(){
        return  ['codtipo','desunidad','escomun'];
    }
    
    private static function  deleteData(){        
        
          (new \yii\db\Query)
    ->createCommand()
    ->delete(self::NAME_TABLE)
    ->execute();
       
    }
}
    
  