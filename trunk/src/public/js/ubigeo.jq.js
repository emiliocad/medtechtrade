/* ubigeo.jq.js */

$(function(){

    

    $('#departamento select').change(function(){
        $.ajax({
            'url':'/jquery/get-provincias/',
            'type': 'post',
            'data':{
                'iddepartamento' : $(this).val()
            },
            'success': function(response){
                $('#provincia').hide();
                $('#provincia select').html('<option>--Selecciona Provincia--</option>');
                for(i in response){
                    provincia = response[i]
                    $option = $('<option>');
                    $option
                    .attr('value',provincia.idprovincia)
                    .text(provincia.nombre)
                    ;
                    $('#provincia select').append($option);
                }
                $('#provincia').slideDown('slow');
            },
            'dataType':'json'
        });
    });

    $('#provincia select').change(function(){
        $.ajax({
            'url':'/jquery/get-distritos/',
            'type': 'post',
            'data':{
                'iddepartamento' : $('#departamento select').val(),
                'idprovincia' : $(this).val()
            },
            'success': function(response){
                $('#distrito').hide();
                $('#distrito select').html('<option>--Selecciona Distrito--</option>');
                for(i in response){
                    distrito = response[i]
                    $option = $('<option>');
                    $option
                    .attr('value',distrito.iddistrito)
                    .text(distrito.nombre)
                    ;
                    $('#distrito select').append($option);
                }
                $('#distrito').slideDown('slow');
            },
            'dataType':'json'
        });
    });

});
