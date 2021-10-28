$(document).ready(function(){

    var _estado;

    _estado = $("#lblEstado").text();   
    
    $('#btnRegresar').click(function(){        
        $.redirect("parametroadmin.php");
    });  

    if(_estado == "Activo"){
        $("#chkEstado").prop("checked", true);
    }

    $("#btnAdd").click(function(){        
        $("#formParam").trigger("reset");
        $("#divcheck").hide();
        $("#header").css("background-color","#183456");
        $("#header").css("color","white");
        $(".modal-title").text("Nuevo Parametro");  
        $("#btnAgregar").text("Agregar");
        $("#modalPARAMETER").modal("show");
        _tipoSave = 'add';
        _estado = 'Activo';
    }); 
    
    $('#btnSave').click(function(){
        _nomparametro = $.trim($("#txtParametro").val());
        _descripcion = $.trim($("#txtDescripcion").val());

        if(_nomparametro == ''){
          
            mensajesalertify("Ingrese Nombre del  Parámetro..!","W","top-center",5);
            return false; 
        }

        if(_count == 0)
        {         
            mensajesalertify("Ingrese al menos un Detalle..!","W","top-center",5);
            return false;
        }
        

        $.ajax({
            url: "../db/parametrocrud.php",
            type: "POST",
            dataType: "json",
            data: {nomparametro:_nomparametro, descripcion:_descripcion, result:_result, estado:'Activo', id:0, opcion:0},            
            success: function(data){
              
                if(data == '0'){

                    $.redirect('parametroadmin.php', {'mensaje': 'Grabado con Exito..!'}); 
                }else{
                  
                    mensajesalertify("Nombre del Parámetro ya Existe..!","E","bottom-right",5);
                }                
            },
            error: function (error) {
                console.log(error);
            }                            
        }); 


    });

});




