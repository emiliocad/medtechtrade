function changeOrder()
{
    $('#frmOrderEquipo #order').change(
        function(){
            $('form#frmOrderEquipo').submit();
        }
        )  
}

$(document).ready(function(){
    
    changeOrder();
});








