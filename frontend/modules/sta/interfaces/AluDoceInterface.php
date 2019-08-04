<?php
namespace frontend\modules\bigitems\interfaces;

interface  PlaceInterface {
    
    /*  Extrae o saca del lugar un activo
     *   @asset: Un item activo 
     */
    public function purgeAsset($asset);
    
    
    /*  Ingresa al lugar un activo
     *   @asset: Un item activo 
     */
    public function inputAsset($asset);
    
    /*  El lugar cambia de lugar; valga la redundncia
     *   aplica para locaiones móviles , como embarcaciones 
     * vehiculos contenedores de activos 
     *   @newPoint: Un punto o direccion física 
     */
    public function move($newPoint);
    
    
}
