<?php
namespace frontend\modules\report\behaviors;
use nemmo\attachments\behaviors\FileBehavior as Fileb;

class FileBehavior extends  Fileb
{
   public function dirFile(){
       return $this->getModule()->getUserDirPath();
   } 
   
}