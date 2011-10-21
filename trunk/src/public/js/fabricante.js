/* fabricante.js */

$(function(){

    var $txtRuc = $('#ruc-element #ruc');

    $txtRuc.blur(function(){
        $.post('/api/whaasdasd',{},function(){

        },'json');

        $.get('/api/whaasdasd',{'id':4},function(){

        },'json');

        $.getJSON('/api/whaasdasd',{},function(){

        });


        $.ajax({
            'url' : '/api/check-ruc',
            'type': 'post',
            'data': {
                'ruc': $(this).val()
            },
            'success': function(response){
                var $txtR = $('#ruc-element #ruc');
                if(response.status=='VALID'){
                    $txtR.css('border','2px solid green');
                }else if (response.status=='INVALID'){
                    $txtR.css('border','2px solid red');
                } else {
                    $txtR.css('border','1px solid black');
                }
            },
            'dataType': 'json'
        });
    });

});