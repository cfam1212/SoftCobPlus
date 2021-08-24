//FUNCIONES ALERTIFY

function mensajesalertify(_mensaje, _tipo, _position, _tiempo){
    alertify.set('notifier','position', _position);
    switch(_tipo){
       case "S": //SUCCESS
            alertify.success(_mensaje , _tiempo , function(){console.log('dismissed');});
           break; 
       case  "W":
            alertify.warning(_mensaje , _tiempo , function(){console.log('dismissed');});
           break;
       case "E":
            alertify.error(_mensaje , _tiempo , function(){console.log('dismissed');});
           break; 
    }
}