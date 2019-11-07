<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\viewMigration;
use frontend\modules\sta\models\Alumnos;
use frontend\modules\sta\models\Talleresdet;
use frontend\modules\sta\models\Materias;
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
                 
                  
         ];
 }   
  private function getTables(){
     $tablas=[
                  'Alumnos'=> '{{%sta_alu}} as a',
                  'Talleresdet'=> '{{%sta_talleresdet}} as b',
                 // 'Materias'=> '{{%sta_materia}} as c',  
                   // 'Cursos'=> '{{%sta_cursos}}  as d',  
                ];
        return $this->prepareTables($tablas);
 }  

 
 public function getWhere(){
      return " b.codalu=a.codalu";//Talleres det Con Alumnos               
             // self::_AND."b.codcur=c.codcur". //Alumnos Con Cursos
             // self::_AND."c.codcur=d.codcur"; //Alumnos Con Cursos
 }
}
