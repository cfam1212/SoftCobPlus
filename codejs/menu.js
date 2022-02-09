$(document).ready(function(){
    
    var _result = [], i = 0, _fila, _data, _id, _opcion, _nombremenu, _iconome, _opcionmp, _iconomp, _estado, _mensaje, _menu, _menuid, _icono;

    _mensaje = $('input#mensaje').val();

    if(_mensaje != ''){
        mensajesalertify(_mensaje,"S","top-center",5);
    }

    $('#btnNuevo').click(function(){
        $.redirect('menunew.php'); 
    });

    $('#btnRegresar').click(function(){
        $.redirect('menu.php');
    });

    $(document).on("click","#btnSubirNivel",function(e){     
        _fila = $(this).closest('tr');
        _data = $('#tablenoorder').dataTable().fnGetData(_fila);
        _id = _data[0];

        $.ajax({
            url: "../db/menucrud.php",
            type: "POST",
            dataType: "json",
            data: {id : _id, opcion : 2},            
            success: function(data){
                TableNoOrder.clear().draw();
                $.each(data,function(i,item){                    
                    _menuid = data[i].MenuId;
                    _menu = data[i].Menu;
                    _icono = data[i].Icono;
                    _estado = data[i].Estado;

                    _checked = _estado == "Activo" ? 'checked' : " "; 

                    _disabledel = '';
                    _disabledit = '';
                    _deshabilitaSub = '';
                    _chkdisable = '';

                    if(_menuid == '200001'){
                        _disabledel = 'disabled';
                        _disabledit = 'disabled';
                        _deshabilitaSub = 'disabled';
                        _chkdisable = 'disabled';
                    }

                    _chekestado = '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoMe" id="chk' + _menuid +
                    '" ' + _checked + ' ' + _chkdisable + ' value=' + _menuid + '/></div></td>'; 
                    
                    _boton = '<td><div class="text-center">' +
                                '<div class="btn-group">' +
                                    '<button class="btn btn-outline-primary btn-sm" ' + _deshabilitaSub + ' id="btnSubirNivel" data-toggle="tooltip" data-placement="top" title="subir nivel">' +
                                    '<i class="fa fa-arrow-up"></i></button>'+
                                    '<button class="btn btn-outline-primary btn-sm ml-3" ' + _disabledit + ' id="btnEditar" data-toggle="tooltip" data-placement="top" title="editar">' +
                                    '<i class="fa fa-pencil-square-o"></i></button>' +
                                    '<button class="btn btn-outline-danger btn-sm ml-3" ' + _disabledel + ' id="btnEliminar" data-toggle="tooltip" data-placement="top" title="eliminar">' +
                                    '<i class="fa fa-trash-o"></i></button>' +
                                '</div></div>' +
                            '</td>'   
                    
                            
                    TableNoOrder.row.add([_menuid, _menu, _icono, _chekestado, _boton]).draw();                
                });                
            },
            error: function (error) {
                console.log(error);
              }
        });
    }); 

    $(document).on("click",".btnEditar",function(){        
        _fila = $(this).closest("tr");
        _data = $('#tablenoorder').dataTable().fnGetData(_fila);
        _id = _data[0];
        $.redirect('menuedit.php', {'id': _id}); //POR METODO POST
    });   
    
    $(document).on("click","#btnEliminar",function(e){        
        _fila = $(this); 
        _row = $(this).closest('tr');  
        _data = $('#tablenoorder').dataTable().fnGetData(_row);
        _id = _data[0];
        _menu = _data[1];
        DeleteMenu();
    });     

    function DeleteMenu(){
        alertify.confirm('El Menu sera eliminado..!!', 'Esta seguro de eliminar ' + _menu + '..? ', function(){ 
    
                     $.ajax({
                        url: "../db/menucrud.php",
                        type: "POST",
                        dataType: "json",
                        data: {id : _id, opcion : 1},
                        success: function(data){
                            if(data == 'NO'){
                                mensajesalertify("Menu no se puede Eliminar, Tiene Tareas Asociadas..!","W","top-right",5);
                            }       
                            else {
                            
                                TableNoOrder.row(_fila.parents('tr')).remove().draw();
                                mensajesalertify("Menu Eliminado..!","E","bottom-center",5);
                            }
                        },
                        error: function (error) {
                            console.error(error);
                        }                  
                    });
              
              }
                , function(){ });
    }

    $('#btnSave').click(function(){
        _id = 0;
        _opcion = 0;
        _nombremenu = $.trim($("#txtmenuname").val());
        _iconome = $.trim($("#txticonome").val());
        _opcionmp = $('#cbomenupadre').val();
        _menupadre = $.trim($('#txtmenump').val());
        _iconomp = $.trim($('#txticonomp').val());
        _estado = "Activo";

        if(_nombremenu == '')
        {
              
            mensajesalertify("Ingrese Nombre del Menú..!","W","top-right",5); 
            return false;
        }

        if(_opcionmp == 2){
            if(_menupadre == ''){
                
                mensajesalertify("Ingrese Nombre del Menú Padre..!!","W","top-right",5);              
                return false;                
            }
        }

        $("input[type=checkbox]:checked").map(function(){
            _result[i] = $(this).val();
            i++;       
        });

        if(i == 0)
        {
         
            mensajesalertify("Seleccione al menos una tarea..!!","W","top-right",5);
            return false;
        }

        $.ajax({
            url: "../db/menucrud.php",
            type: "POST",
            dataType: "json",
            data: {nombremenu: _nombremenu, iconome: _iconome, opcionmp: _opcionmp, menupadre: _menupadre, iconomp: _iconomp, result: _result, 
                estado: _estado, id: _id, opcion: _opcion},            
            success: function(data){   
                if(data == '0'){
                    $.redirect('menu.php', {'mensaje': 'Guardado con Exito..!'});
                    //$.redirect('menu.php',mensajesalertify("Guardado con exito..!","S","top-center",5));
                }else{
                  
                    mensajesalertify("Nombre del Menú ya exixte..!","W","top-right",5);              
                }
            },
            error: function (error) {
                console.log(error);
              }                            
        });        
    });  

    //UPDATE ESTADO MENU BDD
    
    $(document).on("click",".chkEstadoMe",function(){ 
        let _rowid = $(this).attr("id");
        let _idmenu = _rowid.substring(3);
        let _check = $("#chk" + _idmenu).is(":checked");
        let _estadomenu;
       

        if(_check){
            _estadomenu = 'Activo';
            $("#btnEditar" + _idmenu).prop("disabled", "");
        }else 
        {
            _estadomenu = 'Inactivo';
            $("#btnEditar" + _idmenu).prop("disabled", "disabled");
        }

        $.ajax({
            url: "../db/menucrud.php",
            type: "POST",
            dataType: "json",
            data: {id: _idmenu, estado: _estadomenu, opcion: 4},
            success: function(data){
               
            },
            error: function (error) {
                console.log(error);
            }                 
        });

    });

});
