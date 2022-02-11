$(document).ready(function(){
    var _id, _opcion, _data, _estado,_row, _fila, _checked, _depa, _namedepaold, _depa;

    $("#modalDEPARTAMENTO").draggable({
        handle: ".modal-header"
    }); 

    $("#btnNuevo").click(function(){
        $("#formTarea").trigger("reset");
        $("#divcheck").hide();
        $("#txtDepa").val('');
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","black");
        $(".modal-title").text("Nuevo Departamento");  
        $("#modalDEPARTAMENTO").modal("show");
        _id = 0;
        _opcion = 0;
        //_tipo = 1;
        _data = null;
        _estado = 'Activo';
    });

    // $(document).on("click","#chkEstado",function(){
    //     _checked = $("#chkEstado").is(":checked");
      
    //     if(_checked){
    //       $("#lblEstado").text("Activo");
    //       _estado = 'Activo';
    //   }else{
    //       $("#lblEstado").text("Inactivo");
    //       _estado = 'Inactivo';
    //   }
    // });


    $(document).on("click",".btnEditar",function(e){    
        _fila = $(this).closest("tr");
        _data = $('#tabledatadepa').dataTable().fnGetData(_fila);
        _id = _data[0];
        _namedepaold = _data[1];
        $("#txtDepa").val(_namedepaold);

        _estado = $('#tdestado' + _id).text();
        _opcion = 1;

        if(_estado == "Activo"){
            $("#chkEstado").prop("checked", true);
            $("#lblEstado").text("Activo");            
        }else{
            $("#chkEstado").prop("checked", false);
            $("#lblEstado").text("Inactivo");
        }

        $("#divcheck").show();
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","black");
        $(".modal-title").text("Editar Departamento");
        $("#modalDEPARTAMENTO").modal("show");
    });    


    //update estado departamento BDD

    $(document).on("click",".chkEstadoDe",function(){ 
        let _rowid = $(this).attr("id");
        let _iddepa = _rowid.substring(3);
        let _check = $("#chk" + _iddepa).is(":checked");
        $("#btnEditar" + _iddepa).prop("disabled", "disabled");
        let _estadodepa;
        //alert(_btneditar);

        if(_check){
            _estadodepa = 'Activo';
            $('#tdestado' + _iddepa).text('Activo');
            $("#btnEditar" + _iddepa).prop("disabled", "");
        }else 
        {
            _estadodepa = 'Inactivo';
            $('#tdestado' + _iddepa).text('Inactivo');
            $("#btnEditar" + _iddepa).prop("disabled", "disabled");
        }

        $.ajax({
            url: "../db/depacrud.php",
            type: "POST",
            dataType: "json",
            data: {id: _iddepa, estado: _estadodepa, opcion: 4},
            success: function(data){
               
            },
            error: function (error) {
                console.log(error);
            }                 
        });

    });

    $("#formDepartamento").submit(function(e){
        e.preventDefault();

        _depa = $.trim($("#txtDepa").val());  

        if(_depa == '')
        {                   
            mensajesalertify("Ingrese Nombre del Departamento..!","W","top-right",5);  
            return;
        }
  
        if(_opcion == 1){            
            if(_namedepaold != _depa){
                $.ajax({
                    url: "../db/depacrud.php",
                    type: "POST",
                    dataType: "json",
                    data: {nomdepa: _depa, opcion: 2},            
                    success: function(data){
                        if(data[0].Contar  == '1'){
                            mensajesalertify("Departamento ya Existe!!.","W","top-right",5);
                            return;
                        }else{
                            FunGrabar(1);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }                            
                });                
            }else{
                $("#modalDEPARTAMENTO").modal("hide");
            }
        }else{
            FunGrabar(0);
        }  
       
    });

    function FunGrabar(opc){
       
        $.ajax({
            url: "../db/depacrud.php",
            type: "POST",
            dataType: "json",
            data: {id: _id, nomdepa: _depa, estado: _estado, opcion: opc},
            success: function(data){
                if(data[0].Valor == 'Existe'){
                    mensajesalertify("Departamento ya Existe!!.","W","top-right",5);  
                }
                else{
                    _depaid = data[0].Depaid;
                    _nomdepa = data[0].Departamento;
                    _estado = data[0].Estado;
                    
                    _desactivar = '';
                    _checked = '';

                    if(_depaid == 1){
                        _desactivar = 'disabled';
                    }

                    if(_estado == 'Activo'){
                        _checked = 'checked';
                    } 

                    _newestado = '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + _depaid +
                                '" ' + _checked + ' value=' + _depaid + '/></div></td>';

                    _estadooculto = '<td style="display: none;" id="tdestado'+_depaid +'">' + _estado + '</td>';

                    _boton = '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-info btn-sm ml-3 btnEditar"' +
                            ' id="btnEditar'+ _depaid +'"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-outline-danger btn-sm ml-3"'+
                            _desactivar + 'id="btnEliminar"><i class="fa fa-trash-o"></i></button></div></div></td>'   

                    if(_opcion == 0){
                        TableDataDepa.row.add([_depaid, _nomdepa, _boton, _newestado, _estadooculto]).draw();
                    }
                    else{
                        TableDataDepa.row(_fila).data([_depaid, _nomdepa, _boton, _newestado, _estadooculto]).draw();
                    }  
                
                    // mensajesalertify("Grabado Correctamente..!","S","top-center",5);  
                }
                $("#modalDEPARTAMENTO").modal("hide");               
            },
            error: function (error) {
                console.log(error);
            }
        });

    }

    $(document).on("click","#btnEliminar",function(e){
        _fila = $(this);  
        _row = $(this).closest('tr');
        _data = $('#tabledatadepa').dataTable().fnGetData(_row);
        _id = _data[0];
        _depa = $(this).closest("tr").find('td:eq(0)').text(); 
        //_tipo = 4;
        DeleteDepar();        
    });

    function DeleteDepar(){
       
        alertify.confirm('El Departamento sera eliminado..!!', 'Esta seguro de eliminar' + ' ' + _depa + '..?', function(){        
           $.ajax({
               url: "../db/depacrud.php",
               type: "POST",
               dataType: "json",
               data: {id: _id, opcion: 3},                        
               success: function(data){
                   console.log(data);
                   if(data[0].Valor == "Existe"){
                       mensajesalertify("Departamento no se puede Eliminar, está asociada a un Usuario..!","W","top-right",5);  
                   }       
                   else {
                    TableDataDepa.row(_fila.parents('tr')).remove().draw();
                       mensajesalertify("Departamento Eliminado","E","top-center",5);
                   }                            
               },
               error: function (error) {
                   console.log(error);
               }                  
           });              
        },        
            function(){});
       }

});