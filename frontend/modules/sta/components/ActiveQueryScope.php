<?php
namespace frontend\modules\sta\components;
use common\helpers\h;
/* 
 * Esta clase es la que efectua los filtros por facultad segun 
 * el perfil del ususario; es decir 
 * cualquier persona no puede visulaizar registros de otras facultades
 * por convencion el campo de criterio es el campo
 * "codfac" 
 */
class ActiveQueryScope extends \yii\db\ActiveQuery 
{
   public function init(){
       parent::init();
       
       $this->andWhere(
               h::user()->
               profile->
               interlocutor->
               getWhereFacultad()
               );
   }
    
}
