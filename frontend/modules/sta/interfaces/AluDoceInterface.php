<?php
namespace frontend\modules\sta\interfaces;
use Carbon;
/*Esta interfaz es base
 * para los interlocutores Alumnos y profesores
 * que asisten a clases y tutorias
 */
interface  AluDoceInterface extends BaseCargosInterface{
    
   
      /*  Se matricula en la tutoria  
     */
    public function registerProgram($codNewfac);
    
    /*  Cambia de tutoria 
     */
    public function changeProgram($codNewfac);
    
    
    
    /*  Abandona o se retira de tutoria
     */
    public function expireProgram($codNewfac);
    
    
    
    /*  Obtiene sus horarios 
     */
    public function schedule();
    
   
    
    /*  Registra asistencia
     */
    public function assistance(Carbon $date);
    
    
    
    
    
     
    
}
