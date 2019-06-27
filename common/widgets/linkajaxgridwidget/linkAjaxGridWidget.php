<?php
namespace common\widgets\linkajaxgridwidget;
use yii\base\Widget;
use yii;
use yii\web\View;
use yii\base\InvalidConfigException;
class linkAjaxGridWidget extends Widget
{
    public $id;
   public $idGrilla;
    public $evento;
   public $family;   
   public $type;
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
     // $mesage=yii::t('base.verbs','Are you Sure to Delete this Record ?');
   $cadenaJs="$('div[id=\"".$this->idGrilla."\"] [family=\"".$this->family."\"]').on( '".$this->evento."', function() { 
            $.ajax({
              url: this.title,
              type: '".$this->type."',
              data:JSON.parse(this.id) ,
              dataType: 'json',        
             beforeSend: function() {  
             return confirm('".yii::t('base.verbs','Are you Sure to Delete this Record ?')."');
                        },
               error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(json) {
              
               //alert(typeof json['dfdfd']==='undefined');
                        var n = Noty('id');
                       if ( typeof json['error']==='undefined' ) {
                        $.pjax({container: '#".$this->idGrilla."'});
                             $.noty.setText(n.options.id, json['success']);
                             $.noty.setType(n.options.id, 'success'); 
                            
                            }else{
                            $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error');  
                            }
                   
                        }
                        });  "
            . "})";
       
  // echo  \yii\helpers\Html::script($stringJs);
   $this->getView()->registerJs($cadenaJs);
   // $this->getView()->registerJs($stringJs2);
                        }     
        
        
   
   
   
   
}

?>