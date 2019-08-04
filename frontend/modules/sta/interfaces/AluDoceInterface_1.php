<?php
namespace frontend\modules\sta\interfaces;
use Carbon;
/*Esta interfaz es base
 * para los interlocutores Psicologos y trabajadores sociales 
 * que asisten a clases y tutorias
 */
interface  PsicoSocialInterface extends BaseCargosInterface{
    
   
      /*  Evalua alumno  
     */
    public function evaluateAlumno($codal);
    
    
    /*  Prepara el informe alumno
     */
    public function reportAlumno($codalu);
    
    
     /*  Envia informe alumno
     */
    public function sendReportAlumno($codalu,$destino);
    
    
    
}
