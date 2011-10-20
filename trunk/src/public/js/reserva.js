function myBeforeSendCallbackJsFunc(){
    var rpta = confirm("Estas seguro");
    alert(rpta);
                     
}
function myCompleteCallbackJsFunc(data){

    if ( data.id !== ""){
        
        $("#" + data.id).fadeOut("slow");
        alert(data.sms);
    }else{
        alert('vacio');
    }
    
    
}
