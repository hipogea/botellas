<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets;
use kartik\widgets\Activeform as kartikActiveForm;


/**
 * ActiveForm is a widget that builds an interactive HTML form for one or multiple data models.
 *
 * For more details and usage information on ActiveForm, see the [guide article on forms](guide:input-forms).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ActiveFormAdvanced extends kartikActiveForm
{
 
  public function init(){
      parent::init();
     $this->fieldClass = 'common\widgets\ActiveFieldAdvanced';
  }
    /**
     * 
     * @return ActiveField the created ActiveField object.
     * @see fieldConfig
     */
    public function field($model, $attribute, $options = [])
    {
        //var_dump($model->isBlockedField($attribute));die();
        $campo=parent::field($model, $attribute, $options = []);
        if(  method_exists($model,'isBlockedField') &&             
            $model->isBlockedField($attribute)   )        
        $campo->inputOptions['disabled']='disabled';
        //var_dump($campo);die();
        return $campo;
        
    }

    
    
}
