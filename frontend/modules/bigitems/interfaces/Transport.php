<?php
namespace frontend\modules\bigitems\interfaces;

interface  Transport {
    
  public function   moveAsset($asset,$codocu,$numdoc);
  public function   revertMoveAsset();
  
  
    
}
