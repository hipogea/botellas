<?php

namespace console\migrations;

use console\migrations\baseMigration;
/**
 * Class M190718064619Fill_departamentos
 */
class M190718064619Fill_departamentos extends baseMigration
{

 const NAME_TABLE='{{%combovalores}}';
 //const NAME_TABLE_CENTROS='{{%centros}}';
    public function safeUp()
    {
            //echo Documentos::class(); 
        
       //echo yii::$app->basePath; die();
        $model=New \common\models\masters\Combovalores();
            static::setData($model);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
            static::deleteData();
        //echo "m190401_065025_fill_documentos cannot be reverted.\n";
 echo "m190401_065025_fill_documentos was reverted successfully..! .\n";
        ///return false;
    }

    
    private static function  getData(){
       \common\models\masters\Centros::firstOrCreateStatic(['codcen'=>'1203','codsoc'=>'B','nomcen'=>'CENTRO LOGISTICO']);
      $centro= \common\models\masters\Centros::find()->one()->codcen;
        return [
            [$centro,'departamentos','01', 'AMAZONAS'],
            [$centro,'departamentos','02', 'ANCASH'],
            [$centro,'departamentos','03', 'APURIMAC'],
            [$centro,'departamentos', '04', 'AREQUIPA'],
            [$centro,'departamentos','05', 'AYACUCHO'],
            [$centro,'departamentos','06', 'CAJAMARCA'],
            [$centro,'departamentos','07', 'CALLAO'],
            [$centro,'departamentos','08', 'CUSCO'],
            [$centro,'departamentos','09', 'HUANCAVELICA'],
            [$centro,'departamentos','10', 'HUANUCO'],
            [$centro, 'departamentos','11', 'ICA'],
            [$centro,'departamentos','12', 'JUNIN'],
            [ $centro,'departamentos','13', 'LA LIBERTAD'],
            [$centro,'departamentos','14', 'LAMBAYEQUE'],
            [$centro, 'departamentos', '15', 'LIMA'],
            [$centro,'departamentos','16', 'LORETO'],
            [$centro,'departamentos','17', 'MADRE DE DIOS'],
            [$centro, 'departamentos','18', 'MOQUEGUA'],
            [$centro,'departamentos','19', 'PASCO'],
            [$centro,'departamentos','20', 'PIURA'],
            [$centro,'departamentos','21', 'PUNO'],
             [$centro,'departamentos','22', 'SAN MARTIN'],
            [ $centro,'departamentos','23', 'TACNA'],
            [$centro,'departamentos','24', 'TUMBES'],
            [$centro, 'departamentos','25', 'UCAYALI'],
            ];
    }
    
    
    
    
    
    private static function  setData($model){
        $campos=['codcen','nombretabla','codigo','valor'];
        foreach(static::getData() as $clave=>$valorfila){
           
           echo (($model->firstOrCreate(array_combine($campos,$valorfila))))?'Ok: Insert':'Error\n';
        }
    }
    
    private static function  deleteData(){        
        
          (new Query)
    ->createCommand()
    ->delete('{{%combovalores}}', ['nombretabla' => 'departamentos'])
    ->execute();
       
    }
}
