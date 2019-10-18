<?php
namespace frontend\modules\bigitems\database\migrations;
//use yii\db\Migration;
use console\migrations\viewMigration;
use common\models\masters\Clipro;
use common\models\masters\Direcciones;
use common\models\masters\Trabajadores;
use frontend\modules\bigitems\models\Docbotellas;
use frontend\modules\bigitems\models\Detdocbotellas;
use frontend\modules\bigitems\models\Activos;
use  \common\models\masters\Documentos;
use common\helpers\FileHelper;
/**
 * Class m190702_163649_create_view_docbotellas
 */
class m190702_163649_create_view_docbotellas extends viewMigration
{
 const NAME_VIEW='{{%vw_docbotellas}}';
 
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
     return [ /*Doc*/'a.id','a.codpro','a.codestado','a.codtra','a.codven','a.codplaca','a.numero','a.codcen','a.codestado as codestadodoc','a.descripcion','a.fectran','a.fecdocu','essalida','codenvio',
                  /*Clipro*/'b.despro','b.rucpro',
                  /*Detdoc*/ 'c.codigo','c.numdocuref','c.codestado as codestadodet',
                  /*Direcciones partida*/'d.direc as direcpartida','d.coddist as distritopartida','d.codprov as provinciapartida',
                  /*Direcciones llegada*/'d1.direc as direcllegada','d1.coddist as distritollegada','d1.codprov as provinciallegada',
                  /*Activos*/ 'e.descripcion as desactivo',
                  /*Trabajadores vendedor*/'t.ap as apvendedor' ,'t.nombres as nombrevendedor',
                 /*Trabajadores transportista*/ 't1.ap as aptrans','t1.nombres as nombretrans',
               /*Documentos*/'x.desdocu'
         ];
 }   
  private function getTables(){
     $tablas=[
                  'Docbotellas'=> Docbotellas::tableName().' as a',
                  'Clipro'=>Clipro::tableName().' as b',
                  'Detdoc'=> Detdocbotellas::tableName().' as c',
                  'DireccionesLlegada'=> Direcciones::tableName().' as d',
                  'DireccionesPartida'=> Direcciones::tableName().' as d1',               
                  'TrabajadoresV'=> Trabajadores::tableName().' as t',
                  'TrabajadoresT'=> Trabajadores::tableName().' as t1',
                  'Documentos'=> Documentos::tableName().' as x',
                  'Activos'=> Activos::tableName().' as e'
                ];
        return $this->prepareTables($tablas);
 }  

 
 public function getWhere(){
      return " a.codpro=b.codpro".//Con clipro                
                self::_AND."a.ptopartida_id=d1.id".//cON Direcciones
                self::_AND."a.ptollegada_id=d.id". //con direcciones
                self::_AND."a.codtra=t1.codigotra".//con trabajadores
                 self::_AND."a.codven=t.codigotra".//con trabajadores               
                self::_AND."a.codocu=x.codocu". //Con Documentos
                self::_AND."a.id=c.doc_id". //con Detdocbotellas  
                 self::_AND."c.codigo=e.codigo"; //Con Activos
 }
}
