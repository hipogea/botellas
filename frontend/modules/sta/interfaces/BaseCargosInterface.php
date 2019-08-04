<?php
namespace frontend\modules\sta\interfaces;
/*Esta interfaz es base
 * para los interlocutores oargos
 */
interface  BaseCargosInterface{
    
    /*  Cambia de facultad
     */
    public function changeFacultad($codNewfac);
    
    /*Se matricula o registra en un periodo
     * determinado**
     */    
    public function registerPeriodo($codperiodo);
    
    
    /*Obitene los datos de asistencia de 
     * un alumno 
     */
    
    public function assistance($codalu);
    
     
    
}
