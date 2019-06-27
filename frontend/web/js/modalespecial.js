    $(document).on('click', '#btn_contactos', function (e) {
        $('#modal-create-contact').remove();
        $.ajax({
            url: vjs_url,
            type: 'GET',
            dataType: 'JSON',
            /*data: {type: 'item'},*/
            success: function(json) {
                if (json['success']) {
                    $('body').append(json['html']);
                }
            }
        });
    });

    $(document).on('hidden.bs.modal', '#modal-create-tax', function () {
      
    });
      


    
