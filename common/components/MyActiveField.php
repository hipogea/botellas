<?php
namespace common\components;
use yii;
use yii\widgets\ActiveField;

class MyActiveField extends ActiveField
{
   //public $template = "{label}\n{icon}\n{input}\n{hint}\n{error}";
   public $wrapOptions=['class' => 'form-group col-md-6'];
   
    public function textGroup(){
  
    
    echo "<div class=\"form-group col-md-6 \">
    <label for=\"invoice_number\" class=\"control-label\">N&uacute;mero de Factura</label>
    <div class=\"input-group\">
        <div class=\"input-group-addon\"><i class=\"fa fa-file-text-o\"></i></div>
        <input class=\"form-control\" placeholder=\"Ingrese Número de Factura\"  name=\"invoice_number\" type=\"text\" value=\"INV-00002\" id=\"invoice_number\">
    </div>
    
</div> ";
    
    
}

  public function render($content = null)
    {
       
        if ($content === null) {
            
           
            if (!isset($this->parts['{input}'])) {
                $this->textInput();
            }
            
            
            if (!isset($this->parts['{label}'])) {
                $this->label();
            }
            if (!isset($this->parts['{error}'])) {
                $this->error();
            }
            
            
            if (!isset($this->parts['{hint}'])) {
                $this->hint(null);
            }
            
            // var_dump($this->parts); die();
            $content = strtr($this->template, $this->parts);
            //var_dump($content);die();
        } elseif (!is_string($content)) {
            $content = call_user_func($content, $this);
        }

        return "<div class=\"".$this->wrapOptions['class']."\">".$this->begin() . "\n" . $content . "\n" . $this->end()."</div>";
    }


    
    
    
    
    
    
public function icon($options = []){
    if ($options === false) {
            $this->parts['{icon}'] = '';
            return $this;
        }
        $options = array_merge($this->iconOptions, $options);
        $this->parts['{icon}'] = "<div class=\"input-group-addon\"><i class=\"fa fa-file-text-o\"></i></div>";
   //var_dump($this->parts['{icon}']);
        return $this;
}


}

