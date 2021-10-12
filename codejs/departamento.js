$(document).ready(function(){
    var _id, _opcion, _data, _estado, _fila, _checked, _depa,_namedepaold;

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

    
    $(document).on("click","#btnEditar",function(e){      
        _fila = $(this).closest("tr");
        _data = $('#tabledata').dataTable().fnGetData(_fila);
        _id = _data[0];
        _namedepaold = $.trim(_fila.find('td:eq(0)').text());    
        _estado = $.trim(_fila.find('td:eq(1)').text());

        $("#txtDepa").val(_namedepaold);
      

        _opcion = 1;

        if(_estado == "Activo"){
            $("#chkEstado").prop("checked", true);
            $("#lblEstado").text("Activo");            
        }else{
            $("#chkEstado").prop("checked", false);
            $("#lblEstado").text("Inactivo");
        }

        $("#divcheck").show();
        $("#header").css("background-color","#183456");
        $("#header").css("color","white");
        $(".modal-title").text("Editar Departamento");
        $("#modalTAREA").modal("show");
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

    $("#formTarea").submit(function(e){
        e.preventDefault();

        _depa = $.trim($("#txtDepa").val());  

        if(_opcion == 1){            
            if(_namedepaold != _depa){
                $.ajax({
                    url: "../db/depacrud.php",
                    type: "POST",
                    dataType: "json",
                    data: {opcion:1, id: _id, nomdepa: _depa},            
                    success: function(data){
                        if(data[0].contar == '1'){
                           
                            mensajesalertify("Departamento ya Existe!!.","E","bottom-right",5);                   
                        }else{
                            FunGrabar();
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }                            
                });                
            }else{
                FunGrabar();
            }
        }else{
            FunGrabar();
        }  
       
    });

    function FunGrabar(){
        $.ajax({
            url: "../db/depacrud.php",
            type: "POST",
            dataType: "json",
            data: {id:_id, nomdepa:_depa, estado:_estado, opcion:3},
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

    }

});