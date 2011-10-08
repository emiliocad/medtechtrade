$(document).ready(function(){
     var id = readCookie('tabVisible');
     $("#sections-buttons-top #"+id).addClass("selected");
   // $("#sections-buttons-top ul li" ).click(function(e){
     //   var a = e.target.id;  
      //  alert(a);
    //    $("#sections-buttons-top ul li.selected" ).removeClass("selected");
    //    $("#sections-buttons-top #"+a).addClass("selected"); 
        //$(this).toggleClass('selected'); 
        //    createCookie('tabVisible',1,1)
    //});
    
    
    
});

function fnSelected(id){
    createCookie('tabVisible',id,1);
}   