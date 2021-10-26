$(document).ready(function(){

    var _estado;

    _estado = $("#lblEstado").text();   
    
    $('#btnRegresar').click(function(){        
        $.redirect("parametroadmin.php");
    });  

    if(_estado == "Activo"){
        $("#chkEstado").prop("checked", true);
    }



});




