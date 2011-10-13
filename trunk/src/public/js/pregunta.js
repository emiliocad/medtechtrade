function myCompleteCallbackJsFunc(data){

    if ( data.id !== ""){
        $("#dg-rpta").css("display", "none");
        alert('Actualizado');
    }else{
        alert('vacio');
    }
    
    
} 
$(function()
  {
      $('#formulacion').wysiwyg();
  });

