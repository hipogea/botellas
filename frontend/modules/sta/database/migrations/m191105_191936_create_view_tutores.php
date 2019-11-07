<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\viewMigration;

//use common\helpers\FileHelper;
class m191105_191936_create_view_tutores extends viewMigration
{
    const NAME_VIEW='{{%vw_sta_tutores}}';
 
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
     return [ /*Trabajadores*/'a.ap','a.am','a.nombres','a.id as trabajador_id',
              /*Tallepsico*/'b.id','b.talleres_id','b.codtra','b.calificacion','b.nalumnos',
             /*Talleres*/'c.id as taller_id','c.numero','c.codfac','c.descripcion','c.codperiodo','c.codocu',
              ];
 }   
  private function getTables(){
     $tablas=[
                  'Trabajadores'=> '{{%trabajadores}} as a',
                  'Talleres'=> '{{%sta_talleres}} as c',
                  'Piscologos'=> '{{%sta_tallerpsico}} as b',  
                   // 'Cursos'=> '{{%sta_cursos}}  as d',  
                ];
        return $this->prepareTables($tablas);
        
 }  

 
 public function getWhere(){
      return " a.codigotra=b.codtra".//Trabajadores con Psicologos           
             //self::_AND."b.codcur=c.codcur". //PISAOCLOGOS CON TALLERES
             self::_AND."b.talleres_id=c.id"; //PISAOCLOGOS CON TALLERES
 }
}
