<?php
namespace common\widgets\linkajaxgridwidget;
use yii\base\Widget;
use yii;
use yii\web\View;
use yii\base\InvalidConfigException;
class linkAjaxGridWidget extends Widget
{
    public $id;
   public $idGrilla; //Id del sectro Pjax par arefrescar luego de la accion 
    public $evento; //tipode vento js : click, blur, change  etc
   public $family;    //familia de la clase del elemento HTML para tomarlo como selector
   public $type; //TIPO DE EVENTO AJAX  : GET POST 
   public $confirm=false; //SI VA A PREGUNTAR ANTES DE EJECUTAR
   public $question="Está seguro de efectuar esta acción?";
   //public $title; 
    
   // private $_varsJs=[];
    
    public function init()
    {
        
        if($this->type===NULL or !in_array($this->type,['POST','GET','post','get']))
        throw new InvalidConfigException(' The "Type" property is Null. Make sure wit should be  "POST" or "GET"  ');
         
        if($this->idGrilla===NULL)
        throw new InvalidConfigException('The "idGrilla" property is Null.');
        if($this->evento===NULL or !in_array($this->evento,['click','change']))
        throw new InvalidConfigException('The "evento" property is Null or not Valid');
  
        parent::init();
    }

    public function run()
    {
       
        $this->makeJs();
        
    }
  
     
  private function makeJs(){
      $cad=" beforeSend: function() {  
             return confirm('".$this->question."');
                        },";
      $confirm=($this->confirm)?$cad:'';
     // $mesage=yii::t('base.verbs','Are you Sure to Delete this Record ?');
   $cadenaJs="$('div[id=\"".$this->idGrilla."\"] [family=\"".$this->family."\"]').on( '".$this->evento."', function() { 
            $.ajax({
              url: this.title,
              type: '".$this->type."',
              data:JSON.parse(this.id) ,
              dataType: 'json',".$confirm." 
               error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(json) {
             
               //alert(typeof json['dfdfd']==='undefined');
                        var n = Noty('id');
                         $.pjax.reload({container: '#".$this->idGrilla."'});
                       if ( !(typeof json['error']==='undefined') ) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error');  
                          }    

                             if ( !(typeof json['warning']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['warning']);
                              $.noty.setType(n.options.id, 'warning');  
                             } 
                          if ( !(typeof json['success']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['success']);
                              $.noty.setType(n.options.id, 'success');  
                             }       

                           // }else{
                          
                           // }
                            
                            }
                   
                        //}
                        });  "
            . "})";
       
  // echo  \yii\helpers\Html::script($stringJs);
   $this->getView()->registerJs($cadenaJs);
   // $this->getView()->registerJs($stringJs2);
                        }     
        
        
   
   
   
   
}

?>