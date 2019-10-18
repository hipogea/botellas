<?php
namespace frontend\modules\sta\widgets\cboperiodos;
use frontend\modules\sta\helpers\comboHelper;
use yii;
class cboperiodos extends \yii\base\Widget
{
    public $id=null;    
    public $model;//EL modelo
    public $form; //El active FOrm    
    /*
     * Atributos para hacer cumplir le widget
     * en el active field
     */
     public $attribute=null;
     public $value=null;
      public $options=null;
      /********************************/
    
    public function run()
    {
        
      return $this->form->field($this->model, $this->attribute)->
            dropDownList(comboHelper::getCboPeriodos(),
                    ['prompt'=>'--'.yii::t('sta.labels','--Seleccione un valor--')."--",
                     //'class'=>'probandoSelect2',
                        ]
                    ); 
        
    }
    
}
    
