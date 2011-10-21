
$(document).ready(function(){
    var id = readCookie('tabVisible');
    $("#dolphinnav #"+id).addClass("current");
    
});

function fnSelectedItem(id)
    {
    createCookie('tabVisible',id,1);
   
    }