/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#campanita').on('click',function(){ 
    $.ajax({
        url: '/yii-application/frontend/web/site/clear-cache', 
        type:'GET', 
        dataType: 'json', 
        success: function(json) {
            
                            var n = Noty('id');
                             $.noty.setText(n.options.id, json['success']);
                             $.noty.setType(n.options.id, 'success'); 
                   
                        }  
                    
    }); 
                
})
