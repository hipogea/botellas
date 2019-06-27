<?php
namespace common\interfaces\documents;
interface documentBaseInterface extends baseInterface {
    public function printDocument();
    public function viewDocument();
    public function gettCentro();
    public function gettSociedad();
    public function gettEstado();
    public function hasChilds();
    public function getNumber();
    public function gettTitle();  
  public function gettClase();  
  public function gettAbreviatura();
  public function gettPrefijo();
  public function isComprobante();
  public function gettTipo();
    
}
