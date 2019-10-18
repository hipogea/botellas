<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\viewMigration;
use frontend\modules\sta\models\Alumnos;
use frontend\modules\sta\models\Talleresdet;
use common\models\masters\Trabajadores;
//use common\helpers\FileHelper;
class m191013_162159_create_view_alutaller extends viewMigration
{
 const NAME_VIEW='{{%vw_alutaller}}';
 
    public function safeUp()
    {
        
    $table=static::NAME_VIEW;
        if(!$this->existsTable($table)) {
        
        $vista=static::NAME_VIEW;
        $this->createView($vista,
                $this->getFields(),
                $this->getTables(),
                $this->getWhere()
                );
        
 }}
public function safeDown()
    {
     
    $vista=static::NAME_VIEW;    
    $this->dropView($vista);
    }
    
 private function getFields(){
     return [ /*Alu*/'a.ap','a.am','a.nombres','a.codfac','a.dni','a.correo','a.celulares','a.fijos',
                  /*Talleresdet*/'b.id','b.codalu','b.talleres_id','b.fingreso','b.codtra',
                 // /*Trabajadores*/ 'c.codigotra','c.ap','c.am','c.nombres','c,dni',
                  
         ];
 }   
  private function getTables(){
     $tablas=[
                  'Alumnos'=> Alumnos::tableName().' as a',
                  'Talleresdet'=> Talleresdet::tableName().' as b',
                 // 'Trabajadores'=> Materias::tableName().' as c',                  
                ];
        return $this->prepareTables($tablas);
 }  

 
 public function getWhere(){
      return " b.codalu=a.codalu";//Con Alu                
                //self::_AND."b.codcur=c.codcur"; //Con Activos
 }
}
