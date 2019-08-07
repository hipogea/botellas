<?php
namespace frontend\modules\sta\interfaces;

/*Esta interfaz es base
 * para los interlocutores Alumnos y profesores
 * que asisten a clases y tutorias
 */
interface  ProfileInterface { 
    /*  Registra asistencia
     */
    public function matricula();
    
    public function informa();
    
}
