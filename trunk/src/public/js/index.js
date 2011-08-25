/* index.js */

$(function(){

    $('#btnTest').live('click',function(){
        $('div#registrar').slideUp();
    });

});



$(function(){

    var validaMsg = new Array(),val_msg;
    validaMsg['VALID'] = 'Login Disponible';
    validaMsg['INVALID'] = 'Login ya está en uso';
    validaMsg['ERROR'] = 'Hubieron problemas en la validación';

    // Registrar
    $('#frmRegistrar #login').blur(function(){
        $('#login-element span.valida_msg').remove();
        $.ajax({
            'url' : '/api/check-username',  // end-point
            'type': 'post',
            'data' : {
                'username' : $(this).val()
            },
            'success' : function(response){
                if(response.status!='EMPTY'){
                    val_msg='<span class="valida_msg '+response.status+' hide">'
                    + validaMsg[response.status] + '</span>';
                    $('#login-element').append(val_msg);
                    $('#login-element span.valida_msg').slideDown();
                }
            },
            'dataType': 'json'
        });
    });

    $('#frmRegistrar #login-element').append('<img id="ajax-loading" src="/img/ajax-loading.gif" class="hide" />');
    
    $('#ajax-loading').ajaxStart(function() {
        $(this).show();
    }).ajaxStop(function() {
        $(this).hide();
    });



});


