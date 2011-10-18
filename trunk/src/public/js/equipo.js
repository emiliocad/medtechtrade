function myCompleteCallbackJsFunc(data){

    if ( data.id !== ""){
        
        $("#" + data.id).fadeOut("slow");
        alert(data.id);
    }else{
        alert('vacio');
    }
    
    
}
