$(document).ready(function(){
    var _id, _opcion, _data, _estado, _fila, _checked,_depa;

    $("#modalTAREA").draggable({
        handle: ".modal-header"
    }); 

    $("#btnNuevo").click(function(){
        $("#formTarea").trigger("reset");
        $("#divcheck").hide();
        $("#header").css("background-color","#183456");
        $("#header").css("color","white");
        $(".modal-title").text("Nuevo Departamento");  
        $("#modalTAREA").modal("show");
        _id = 0;
        _opcion = 1;
        _data = null;
        _estado = 'Activo';
    });

    $(document).on("click","#chkEstado",function(){
        _checked = $("#chkEstado").is(":checked");
      
        if(_checked){
          $("#lblEstado").text("Activo");
          _estado = 'Activo';
      }else{
          $("#lblEstado").text("Inactivo");
          _estado = 'Inactivo';
      }
    });




    $('#btnSave').click(function(){
        _depa = $.trim($("#txtDepa").val());
        _estado = "Activo";

        if(_depa == '')
        {       
            
            mensajesalertify("Ingrese Nombre del Departamento..!","W","top-center",5);  
            return;
        }

  
        $.ajax({
            url: "../db/depacrud.php",
            type: "POST",
            dataType: "json",
            data: {tipo:14, auxv1:"", auxv2:_perfil, auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:0, auxi2:0, auxi3:0, auxi4:0, auxi5:0, auxi6:0, 
            opcion:1},
            success: function(data){                    
               
            },
            error: function (error) {
                console.log(error);
            }
        });
    }); 

});