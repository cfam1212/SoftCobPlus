$(document).ready(function(){
    
    var _result = [], i = 0, _fila, _data, _id, _opcion, _nombremenu, _iconome, _opcionmp, _iconomp, _estado, _mensaje, _menu, _menuid, _icono;

    _mensaje = $('input#mensaje').val();

    if(_mensaje != ''){
        mensajesalertify(_mensaje,"S","top-right",5);
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
        // row_index = $(this).closest("tr").index();
        _id = _data[0];
        //nombremenu = "", iconome = "", opcionmp = "", menupadre = "", iconomp = "", estado = "";
        //result = [];
        _opcion = 2;


        $.ajax({
            url: "../db/menucrud.php",
            type: "POST",
            dataType: "json",
            data: {id : _id, opcion : _opcion},            
            success: function(data){
                TableNoOrder.clear().draw();
                $.each(data,function(i,item){                    
                    _menuid = data[i].MenuId;
                    _menu = data[i].Menu;
                    _icono = data[i].Icono;
                    _estado = data[i].Estado;
                    TableNoOrder.row.add([_menuid, _menu, _icono, _estado]).draw();                
                });                
            },
            error: function (error) {
                console.log(error);
              }
        }); 
    }); 

    $(document).on("click","#btnEditar",function(){        
        _fila = $(this).closest("tr");
        _data = $('#tablenoorder').dataTable().fnGetData(_fila);
        _id = _data[0];
        _menu = _fila.find('td:eq(0)').text();
        $.redirect('menuedit.php', {'id': _id}); //POR METODO POST
    });   
    
    $(document).on("click","#btnEliminar",function(e){        
        _fila = $(this); 
        _row = $(this).closest('tr');  
        _data = $('#tablenoorder').dataTable().fnGetData(_row);
        _id = _data[0];
        _opcion = 1;
        _menu = _data[1];
        DeleteMenu();
    });     

    function DeleteMenu(){
        

        alertify.confirm('El Registro sera eliminado..!!', 'Esta seguro de eliminar el menu..?', function(){ 
    
                     $.ajax({
                        url: "../db/menucrud.php",
                        type: "POST",
                        dataType: "json",
                        data: {id : _id, opcion : _opcion},
                        success: function(data){
                            if(data == 'NO'){
                             
                               
                                mensajesalertify("Menu no se puede Eliminar, Tiene Tareas Asociadas..!","E","bottom-right",5);
                            }       
                            else {
                            
                                TableNoOrder.row(_fila.parents('tr')).remove().draw();
                                mensajesalertify("Registro Eliminado..!","E","bottom-center",5);
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
              
            mensajesalertify("Ingrese Nombre del Menú..!","W","top-center",5); 
            return false;
        }

        if(_opcionmp == 2){
            if(_menupadre == ''){
                
                mensajesalertify("Ingrese Nombre del Menú Padre..!!","W","top-center",5);              
                return false;                
            }
        }

        $("input[type=checkbox]:checked").map(function(){
            _result[i] = $(this).val();
            i++;       
        });

        if(i == 0)
        {
         
            mensajesalertify("Seleccione al menos una tarea..!!","W","top-center",5);
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
                    //$.redirect('menu.php',mensajesalertify("Guardado con exito..!","S","bottom-center",5));
                }else{
                  
                    mensajesalertify("Nombre del Menú ya exixte..!","E","bottom-right",5);              
                }
            },
            error: function (error) {
                console.log(error);
              }                            
        });        
    });    

});
