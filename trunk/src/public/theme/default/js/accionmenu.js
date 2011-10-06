
$(document).ready(function(){
    
    $("#sections-buttons-top ul li" ).click(function(e){
        var a = e.target.id;  
        $("#sections-buttons-top ul li.selected" ).removeClass("selected");
        $("sections-buttons-top #"+a).addClass("selected"); 
        //$(this).toggleClass('selected'); 
    });
});
