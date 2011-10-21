function myBeforeSendCallbackJsFunc(){
    if (!confirm("desea eliminar la imagen")) {
        exit;
    } 
}

function myCompleteCallbackJsFunc(data){

    if ( data.id !== ""){
        
        $("#" + data.id).fadeOut("slow");
        alert(data.sms);
    }else{
        alert('vacio');
    }
    
    
}
