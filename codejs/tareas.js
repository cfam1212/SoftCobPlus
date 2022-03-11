$(document).ready(function(){
    
    var _id, _opcion, _data, _estado, _fila, _nameoldtarea, _ruta, _icono, _checked, _row, _tarea

    
  
    $("#modalTAREA").draggable({
        handle: ".modal-header"
    }); 

    $("#btnNuevo").click(function(){
        $("#formTarea").trigger("reset");
        $("#divcheck").hide();
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","black");
        $(".modal-title").text("Nueva Tarea");  
        $("#modalTAREA").modal("show");
        _id = 0;
        _opcion = 1;
        _data = null;
        _estado = 'Activo';
    });

    $(document).on("click",".btnEditar",function(e){      
        _fila = $(this).closest("tr");
        _data = $('#tabledata').dataTable().fnGetData(_fila);
        _id = _data[0];
        _nameoldtarea = _data[1];
        _ruta = _data[2];
        _icono = _data[3]
        //_estado = $.trim(_fila.find('td:eq(3)').text());
        //_nameoldtarea = $.trim(_fila.find('td:eq(0)').text());

        $("#txtTarea").val(_nameoldtarea);
        $("#txtRuta").val(_ruta);
        $("#txtIcono").val(_icono);

        _opcion = 2;

        if(_estado == "Activo"){
            $("#chkEstado").prop("checked", true);
            $("#lblEstado").text("Activo");            
        }else{
            $("#chkEstado").prop("checked", false);
            $("#lblEstado").text("Inactivos");
        }

        //$("#divcheck").show();
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","black");
        $(".modal-title").text("Editar Tarea");
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

    //EDITAR ESTADO TAREA

    $(document).on("click",".chkEstadoTa",function(){ 
        let _rowid = $(this).attr("id");
        let _idtare = _rowid.substring(3);
        let _check = $("#chk" + _idtare).is(":checked");
        let _estadotarea;
        
        if(_check){
            _estadotarea = 'Activo';
            $("#btnEditar" + _idtare).prop("disabled", "");
         
        }else 
        {
            _estadotarea = 'Inactivo';
            $("#btnEditar" + _idtare).prop("disabled", "disabled");
        }

        $.post({
            url: "../db/tareacrud.php",
            dataType: "json",
            data: {id: _idtare, estado: _estadotarea, opcion: 3},
            success: function(data){
               
            },
            error: function (error) {
                console.log(error);
            }                 
        });

    });

    $(document).on("click","#btnEliminar",function(e){
        _fila = $(this);  
        _row = $(this).closest('tr');
        _data = $('#tabledata').dataTable().fnGetData(_row);
        _id = _data[0];
        _tarea = $(this).closest("tr").find('td:eq(0)').text(); 
        _opcion = 3;
        DeleteTarea();        
    });
    
    function DeleteTarea(){
       
     alertify.confirm('Tarea sera eliminada..!!', 'Esta seguro de eliminar' + ' ' + _tarea + '..?', function(){ 
    
        $.ajax({
            url: "../db/tareacrud.php",
            type: "POST",
            dataType: "json",
            data: {opcion: 1, id: _id},                        
            success: function(data){
                if(data == "NO"){
                    swal.close();
                    mensajesalertify("Tarea no se puede Eliminar, está asociada a un Menú..!!","W","top-right",3);  
                }       
                else {
                    Swal.close();
                    TableData.row(_fila.parents('tr')).remove().draw();
                    mensajesalertify("Tarea Eliminada","E","top-center",2);
                }                            
            },
            error: function (error) {
                console.log(error);
            }                  
        });
    
    
              }
                , function(){alertify.error('Cancelado');});
    }
    
    $("#formTarea").submit(function(e){
        e.preventDefault();
        _tarea = $.trim($("#txtTarea").val());
        _ruta = $.trim($("#txtRuta").val());
        _icono = $.trim($("#txtIcono").val());
        if(_tarea == ''){
            mensajesalertify("Ingrese Tarea!!.","W","top-right",3); 
            return;   
        }
        if(_ruta == ''){
            mensajesalertify("Ingrese una Ruta!!.","W","top-right",3); 
            return;   
        }
        if(_opcion == 2){            
            if(_nameoldtarea != _tarea){
                $.ajax({
                    url: "../db/tareacrud.php",
                    type: "POST",
                    dataType: "json",
                    data: {opcion:2, id: _id, tarea: _tarea, ruta:_ruta, icono:_icono, estado:_estado},            
                    success: function(data){
                        if(data == '1'){
                            mensajesalertify("Tarea ya Existe..!!","W","top-right",3);                   
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
            url: "../db/tareacrud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:0, id:_id, tarea:_tarea, ruta:_ruta, icono:_icono, estado:_estado},            
            success: function(data){
                if(data == 'SI'){
                    mensajesalertify("Tarea ya Existe..!!","W","top-right",3);                   
                }else{
                    _tareaid = data[0].TareaId;
                    _tarea = data[0].Tarea;
                    _ruta = data[0].Ruta;
                    _icono = data[0].Icono
                    _estado = data[0].Estado;
                    if(_tareaid == 100001 || _tareaid == 100002 || _tareaid == 100003 || _tareaid == 100004){
                        _desactivar = 'disabled';
                    }else{
                        _desactivar = '';
                    }
                    _checked = '';

                    if(_estado == 'Activo'){
                        _checked = 'checked';
                    }    
                    
                    _newestado = '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoTa" id="chk' + _tareaid +
                                 '" ' + _checked + ' value=' + _tareaid + '/></div></td>';

                    _boton = '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-info btn-sm ml-3 btnEditar"' +
                             ' id="btnEditar'+ _tareaid +'"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-outline-danger btn-sm ml-3"'+
                            _desactivar + 'id="btnEliminar"><i class="fa fa-trash-o"></i></button></div></div></td>'
                              
                    if(_opcion == 1){
                        TableData.row.add([_tareaid, _tarea, _ruta, _icono,_boton, _newestado]).draw();
                    }
                    else{
                        TableData.row(_fila).data([_tareaid, _tarea, _ruta, _icono,_boton, _newestado]).draw();
                    }  
                  
                    // mensajesalertify("Grabado Correctamente..!","S","top-center",5);  
                    $("#modalTAREA").modal("hide");
                }
            },
            error: function (error) {
                console.log(error);
            }                            
        }); 
    }    

});