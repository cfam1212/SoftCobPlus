$(document).ready(function(){
    var _id, _opcion, _data, _estado, _fila, _checked, _depa;

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
        _opcion = 0;
        _data = null;
        _estado = 'A';
    });

    $(document).on("click","#chkEstado",function(){
        _checked = $("#chkEstado").is(":checked");
      
        if(_checked){
          $("#lblEstado").text("Activo");
          _estado = 'A';
      }else{
          $("#lblEstado").text("Inactivo");
          _estado = 'I';
      }
    });

    $('#btnSave').click(function(){
        _depa = $.trim($("#txtDepa").val());        

        if(_depa == '')
        {                   
            mensajesalertify("Ingrese Nombre del Departamento..!","W","top-center",5);  
            return;
        }
  
        $.ajax({
            url: "../db/depacrud.php",
            type: "POST",
            dataType: "json",
            data: {id:_id, nomdepa:_depa, estado:_estado, opcion:_opcion},
            success: function(data){                                 
                _depaid = data[0].Depaid;
                _nomdepa = data[0].Departamento;
                _estado = data[0].Estado;

                if(_depaid == 1){
                    _desactivar = 'disabled="disabled"';
                }else{
                    _desactivar = '';
                }

                _boton = '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-info btn-sm ml-3"' +
                         'id="btnEditar"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-outline-danger btn-sm ml-3"'+
                        _desactivar + 'id="btnEliminar"><i class="fa fa-trash-o"></i></button></div></div></td>'   

                if(_opcion == 0){
                    TableData.row.add([_depaid, _nomdepa, _estado, _boton]).draw();
                }
                else{
                    TableData.row(_fila).data([_depaid, _nomdepa, _estado, _boton]).draw();
                }  
              
                mensajesalertify("Grabado Correctamente..!","S","bottom-center",5);  
                $("#modalTAREA").modal("hide");               
            },
            error: function (error) {
                console.log(error);
            }
        });
    }); 

});