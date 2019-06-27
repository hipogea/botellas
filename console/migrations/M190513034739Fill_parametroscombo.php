<?php

namespace console\migrations;
use console\migrations\baseMigration;
use common\models\masters\ModelCombo;
use frontend\models\masters\Trabajadores;


/**
 * Class M190513034739Fill_parametroscombo
 */
class M190513034739Fill_parametroscombo extends baseMigration
{

 const NAME_TABLE='{{%combo}}';
 const NAME_TABLE_CENTROS='{{%centros}}';
    public function safeUp()
    {
            //echo Documentos::class(); 
        
       //echo yii::$app->basePath; die();
        $model=New ModelCombo();
            static::setData($model);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $model=New ModelCombo();
            static::deleteData($model);
        //echo "m190401_065025_fill_documentos cannot be reverted.\n";
 echo "m190401_065025_fill_documentos was reverted successfully..! .\n";
        ///return false;
    }

    private static function  getData(){
        return [
            ['activos.tipo','1'], //el 1 0 cero es para identifdcar si este valor depende del centro logistio  o no 
            ['guia.motivos','1'],
            ['guia.estado','1'],
            ['detgui.estado','1'],
            ['maestrocompo.tipo','1'],
            ['maestrocompo.grupo','1'],
            ['grupoventas','0'],
            ['documento.identidad','1'],
            ['impuesto','1'],
            ['empresa.area','1'],            
            ];
    }
    
    private static function  setData($model){
        $campos=['parametro','clavecentro'];
        foreach(static::getData() as $clave=>$valorfila){
           
           echo (($model->firstOrCreate(array_combine($campos,$valorfila))))?'Ok: Insert':'Error\n';
        }
    }
    
    private static function  deleteData($model){        
        
           ModelCombo::deleteAll("1=1");
       
    }
}
