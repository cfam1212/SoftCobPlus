$(document).ready(function(){
    var _codigo, _descripcion, _count = 0, _result = [], _objeto, _estado, _continuar, 
    _estadoold, _descripcionold, _checked;

    $("#modalPARAMETER").draggable({
        handle: ".modal-header"
    });
    
    $("#modalPERFIL").draggable({
        handle: ".modal-header"
    });    

    $('#cboPerfil').select2();

    $('#btnRegresar').click(function(){        
        $.redirect("");
    });  

    $('#btnAgregar').click(function(){        
        
        _codigo = $('#cboPerfil').val();
        _descripcion = $.trim($('#txtDescripcion').val());
        _estado = 'Activo';
        _continuar = true;

        _checked = '';

        if(_estado == 'Activo'){
            _checked = 'checked';
        } 

        if(_codigo == '0')
        {
            mensajesalertify("Seleccione Tipo Perfil..!","W","top-right",5);
            _continuar = false;
            return false;
        }

        if(_descripcion == '')
        {
            mensajesalertify("Ingrese Descripción..!","W","top-right",5);
            _continuar = false;
            return false;
        }        

        if(_continuar)
        {
            $.post({
                url: "../db/perfilescacrud.php",
                dataType: "json",
                data: {cboid: _codigo, descripcion: _descripcion, opcion: 0,},            
                success: function(data){
                    debugger;
                    if(data[0].Existe == 'Existe'){
                         mensajesalertify("Descripción ya Existe..!","S","bottom-center",5);
                    }else{
                        _id = data[0].Codigo;
                        _desc = data[0].Descripcion;
                        _estado = data[0].Estado;

                        _checked = '';
                        _desactivar = ''
    
                        if(_estado == 'Activo'){
                            _checked = 'checked';
                        }else   _desactivar = 'disabled';  
                        
                        _newestado = '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoTa" id="chk' + _id +
                                     '" ' + _checked + ' value=' + _id + '/></div></td>';
    
                        _boton = '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-info btn-sm ml-3 btnEditar"' + _desactivar +
                                 ' id="btnEditar' + _id +'"><i class="fa fa-pencil-square-o"></i></button><button type="button" class="btn btn-outline-danger btn-sm ml-3 btnEliminar"' +
                                 ' id="btnEliminar"><i class="fa fa-trash-o"></i></button></div></div></td>'
                        
                        TableDataPerfilCalifica.row.add([_id, _desc, _boton, _newestado]).draw();
                    }
                                
                },
                error: function (error) {
                    console.log(error);
                }                            
            }); 
        }
    });

    $(document).on("click",".btnEditar",function(){
        _fila = $(this).closest("tr");
        _data = $("#tblperfilcalifica").dataTable().fnGetData(_fila);

        _descripcionold = _data[1];

        $("#txtDescripcionedit").val(_data[1]);
        $("#hidden_row_id").val(_data[0]);
        
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","white");
        $(".modal-title").text("Editar Descripcion");       
        $("#modalPERFIL").modal("show");
    });

    $('#btnModificar').click(function(){        
        
        _continuar = false, _seguir = false;

        _descripcion = $.trim($('#txtDescripcionedit').val());
        _idperfil = $.trim($('#hidden_row_id').val());

        _cboid = $('#cboPerfil').val();

        if(_descripcion == '')
        {
            mensajesalertify("Ingrese Descripción..!","W","top-right",5);
            return;
        }        
        
        if(_descripcionold.toUpperCase() != _descripcion.toUpperCase())
        {
            $.each(_result,function(i,item)
            {
                if(item.arrydescripcion.toUpperCase() == _descripcion.toUpperCase())
                {                        
                    mensajesalertify("Descripción ya Existe..!","W","top-right",5); 
                    _continuar = false;
                    return false;
                }else{
                    _continuar = true;
                }
            });
        }else _continuar = true;

        if(_continuar)
        {
            FunRemoveItemFromArr(_result, _descripcionold);

            _objeto = {
                arrycodigo : parseInt(_id),
                arrydescripcion : _descripcion
            } 

            _result.push(_objeto);

            $.ajax({
                url: "../db/perfilescacrud.php",
                type: "POST",
                dataType: "json",
                data: {cboid: _cboid, id: _idperfil, descripcion: _descripcion, opcion: 4},
                success: function(data){
                    _id = data[0].Codigo;
                    _desc = data[0].Descripcion;
                    _estado = data[0].Estado;

                    _checked = '';
                    _disabledit = '';

                    if(_estado == 'Activo'){
                        _checked = 'checked';
                    }else   _disabledit = 'disabled';  
                    
                    _newestado = '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstado" id="chk' + _id +
                                 '" ' + _checked + ' value=' + _id + '/></div></td>';

                    _boton = '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-info btn-sm ml-3 btnEditar"' + _disabledit +
                             ' id="btnEditar' + _id + '"><i class="fa fa-pencil-square-o"></i></button></div></div></td>';

                    TableDataPerfilCalifica.row(_fila).data([_id, _desc, _boton, _newestado]).draw();
                },
                error: function (error) {
                    console.log(error);
                }                            
            });

            $("#modalPERFIL").modal("hide");

        }
    });  
    
    function FunRemoveItemFromArr(arr, deta)
    {
        $.each(arr,function(i,item){
            if(item.arrydetalle == deta)
            {
                arr.splice(i, 1);
                return false;
            }else{
                continuar = true;
            }
        });        
    };    

    function FunRemoveItemFromArr(arr, deta)
    {
        $.each(arr,function(i,item){
            if(item.arrydescripcion == deta)
            {
                arr.splice(i, 1);
                return false;
            }else{
                continuar = true;
            }
        });        
    };    


    $('#cboPerfil').change(function(){
        _cboid = $(this).val(); //obtener el id seleccionado

        if(_cboid != '0'){
            TableDataPerfilCalifica.clear().draw();
            $.ajax({
                url: "../db/perfilescacrud.php",
                type: "POST",
                dataType: "json",
                data: {cboid: _cboid, opcion:1},            
                success: function(data){
                    $.each(data,function(i,item){
                        _id = data[i].Codigo;
                        _desc = data[i].Descripcion;
                        _estado = data[i].Estado;
                    
                        _checked = '';
                        _disabledit = '';

                        if(_estado == 'Activo'){
                            _checked = 'checked';
                        }else   _disabledit = 'disabled';  
                        
                        _newestado = '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstado" id="chk' + _id +
                                     '" ' + _checked + ' value=' + _id + '/></div></td>';
    
                        _boton = '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-info btn-sm ml-3 btnEditar"' + _disabledit +
                                 ' id="btnEditar' + _id + '"><i class="fa fa-pencil-square-o"></i></button></div></div></td>';

                        TableDataPerfilCalifica.row.add([_id, _desc, _boton, _newestado]).draw();
                        
                        _objeto = {
                            arrycodigo : parseInt(_id),
                            arrydescripcion : _desc
                        }            
            
                        _result.push(_objeto); 
                    }); 
                                        
                },
                error: function (error) {
                    console.log(error);
                    }
            }); 
        }
      
  });


  $(document).on("click",".chkEstado",function(){ 
    let _rowid = $(this).attr("id");
    let _idperfil = _rowid.substring(3);
    let _check = $("#chk" + _idperfil).is(":checked");
    let _estadope;

    _cboid = $('#cboPerfil').val();

    if(_check){
        _estadope = 'A';
        $("#btnEditar" + _idperfil).prop("disabled", "");
       
    }else 
    {
        _estadope = 'I';
        $("#btnEditar" + _idperfil).prop("disabled", "disabled");
    }

    $.ajax({
        url: "../db/perfilescacrud.php",
        type: "POST",
        dataType: "json",
        data: {cboid: _cboid, estado: _estadope, id: _idperfil, opcion: 3},
        success: function(data){
           
        },
        error: function (error) {
            console.log(error);
        }                 
    });

  });

});