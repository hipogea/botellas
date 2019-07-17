<?php
namespace common\behaviors;
use nemmo\attachments\behaviors\FileBehavior as Fileb;
use nemmo\attachments\models\File;
class FileBehavior extends  Fileb
{
   public function dirFile(){
      // return $this->getModule()->getUserDirPath();
   } 
   public function getFilesByExtension($ext=null){
       if(is_null($ext))
            throw new \yii\base\Exception(Yii::t('base.errors', 'The extension parameter is null'));
        if(substr($ext,0,1)=='.'){
            $ext=substr($ext,1);
        }
        $fileQuery = File::find()
            ->where([
                'itemId' => $this->owner->id,
                'model' => $this->owner->getShortNameClass(),
                'type'=>$ext,
            ]);
        $fileQuery->orderBy(['id' => SORT_ASC]);

        return $fileQuery->all();
   }
   
}
