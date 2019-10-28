<?php
namespace frontend\modules\sta\database\migrations;
//use yii\db\Migration;
use console\migrations\viewMigration;
use frontend\modules\sta\models\Alumnos;
use frontend\modules\sta\models\Aluriesgo;
use frontend\modules\sta\models\Materias;
use frontend\modules\sta\models\Cursos;
use common\helpers\FileHelper;
class m191013_162180_create_view_aluriesgo  extends viewMigration
{
 const NAME_VIEW='{{%vw_aluriesgo}}';
 
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
                  /*Aluriesgo*/'b.id','b.codcur','b.codalu','b.nveces','b.codperiodo','b.codcar',
                  /*Materias*/ 'd.nomcur','c.creditos','c.electivo','c.ciclo',
                  
         ];
 }   
  private function getTables(){
     $tablas=[
                  'Alumnos'=> Alumnos::tableName().' as a',
                  'Aluriesgo'=>Aluriesgo::tableName().' as b',
                  'Materia'=> Materias::tableName().' as c',    
                  'Curso'=> Cursos::tableName().' as d',   
                ];
        return $this->prepareTables($tablas);
 }  

 
 public function getWhere(){
      return " b.codalu=a.codalu".//Con Alu                
              self::_AND."b.codcur=c.codcur". //Con Materias
       self::_AND."c.codcur=d.codcur"; //Con Cursos
}
}
