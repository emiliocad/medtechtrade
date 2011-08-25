/* demo.jq.js */

$(function(){

    $('#clear').click(function(){
        $('#mda li').css('background','none');
    });

    $('#t1').click(function(){

        $('#mda li').css('background','none');

        $('#mda li:odd').css('background','yellow');
        $('#mda li:nth-child(3)').css('background','red');
        $('#mda li:last').css('background','green');

    });

    $('#t2').click(function(){

        $('#mda li').css('background','none');

        $('#mda li:odd').css('background','yellow');
        $('#mda li:nth-child(odd)').css('background','red');

    });

    $('#t3').click(function(){

        $('#mda li').css('background','none');

        $('#mda li:nth-child(3n)').css('background','green');
        $('#mda li:nth-child(4n)').css('background','red');

    });

    $('#btnEnviar').click(function(){

        //var htmlForm = $('#derecha').html();

        $('#derecha').slideUp(3000,function(){
            
            $('#derecha').html('<p>Loading...</p>').show();
            
            $.ajax({
                'url' : '/jquery/genera-img',
                'type' : 'post',
                'data' : {
                    'nombre': $('#txtNombre').val(),
                    'apellido': $('#txtApellido').val()
                },
                'success' : function(response){
                    
                    //$('#derecha').html(htmlForm).hide();
                    //$('#derecha').html( response ).hide();
                    $img = $('<img>');
                    $img.attr('src',response.path);
                    $('#derecha').html('').hide();
                    $('#derecha').append($img);

                    $('#derecha').slideDown('slow');

                    
                },
                'dataType' : 'json'
                
            });

        });


        return false;
    });

});
