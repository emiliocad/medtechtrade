$(function(){
    
    $('#login-element').append('<img id="alIcon" src="/img/ajax-loading.gif" />');
    $('#alIcon').hide();
    
    
    $('#alIcon').ajaxStart(function(){
        $('#chkIcon').remove();
        $(this).show();
    });
    $('#alIcon').ajaxStop(function(){
        $(this).hide();
    });
    
    $('#login').blur(function(){
        $.ajax({
            'type':'post',
            'url':'/api/validar-login',
            'data' : {
                'login': $(this).val()
            },
            'success' : function(response){
                $('#chkIcon').remove();
                if (response.msg == 'OK'){
                    $('#login').parent().append('<img id="chkIcon" src="/img/ok.gif" />');
                } else{
                    $('#login').parent().append('<img id="chkIcon" src="/img/error.gif" />');
                }
            },
            'error' : function(){
                
            },
            'dataType': 'json'
        });
    });

    
});