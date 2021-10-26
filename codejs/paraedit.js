$(document).ready(function(){

    var _estado;

    $('#btnRegresar').click(function(){        
        $.redirect("parametroadmin.php");
    });  

    if(_estado == "Activo"){
        $("#chkEstado").prop("checked", true);
    }



});




