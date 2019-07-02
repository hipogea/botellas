<?php
namespace frontend\modules\bigitems\interfaces;

interface  Transport {
    
  public function   moveAsset($codocu, $numdoc, $fecha, $nuevolugar);
  public function   revertMoveAsset();
  
  public function   canMoveAsset();
     public function   canRevertMoveAsset();
}
