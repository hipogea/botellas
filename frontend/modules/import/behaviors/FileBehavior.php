<?php
namespace frontend\modules\import\behaviors;
use common\behaviors\FileBehavior as Fileb;
use nemmo\attachments\models\File;
use common\helpers\FileHelper;

/*
 * Esta clase se extiende de la clase original 
 * nemmo\attachments\behaviors\FileBehavior
 * Le ahorrara mucho trabajo al momento de trabajar
 * con archivos adjuntos, en especial sin son imagenes
 * 
 */

class FileBehavior extends  Fileb
{
  
    public function saveUploads($event)
    {
        parent::saveUploads($event);
     //$this->owner->completeData
    }

    public function deleteUploads($event)
    {
        parent::deleteUploads($event);
        
    }
 
 
 
   
}
