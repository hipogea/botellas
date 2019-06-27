<?php
namespace console\migrations;
use console\migrations\baseMigration;
use common\models\masters\Documentos;
use frontend\models\masters\Trabajadores;
/**
 * Class m190401_065025_fill_documentos
 */
class m190401_065025_fill_documentos extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            //echo Documentos::class(); 
        
       //echo yii::$app->basePath; die();
        $model=New Documentos();
            static::setData($model);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $model=New Documentos();
            static::deleteData($model);
        //echo "m190401_065025_fill_documentos cannot be reverted.\n";
 echo "m190401_065025_fill_documentos was reverted successfully..! .\n";
        ///return false;
    }

    private static function  getData(){
        //$campos=['codocu','codocupadre','desdocu','clase','tipo','abreviatura'];
        return [
            ['100', 'GUIA DE REMISION' ,'D','10','GRE'],
            ['101', 'DETALLE GUIA DE REMISION' ,'D','10','DGR'],
            ['102', 'FACTURA' ,'D','10','FAC'],
            ['103', 'DETALLE FACTURA' ,'D','10','DFA'],
            ['104', 'VALE ALMACEN' ,'D','10','VAL'],
            ['105', 'DETALLE VALE ' ,'D','10','DVA'],
            ['106', 'ORDEN DE COMPRA' ,'D','10','OCO'], 
            ['107', 'DETALLE ORDEN DE COMPRA' ,'D','10','OCO'], 
            ];
    }
    
    private static function  setData($model){
        $campos=['codocu','desdocu','clase','tipo','abreviatura'];
        foreach(static::getData() as $clave=>$valorfila){
           
           echo (($model->firstOrCreate(array_combine($campos,$valorfila))))?'Ok: Insert':'Error\n';
        }
    }
    
    private static function  deleteData($model){
        $campos=['codocu','codocupadre','desdocu','clase','tipo','abreviatura'];
        foreach(static::getData() as $clave=>$valorfila){
           $model->deleteAll(['codocu'=>$valorfila[0]]);
        }
    }
    
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190401_065025_fill_documentos cannot be reverted.\n";

        return false;
    }
    */
}
