$(document).ready(function(){
    var _mensaje,_continuar,_crear,_modificar,_eliminar,_result,_fila,_row,_data,_id,_perfil,_observacion,_estado,_result = [];

    _mensaje = $('input#mensaje').val();
    
    /*if(_mensaje != ''){
        mensajesalertify(_mensaje,"S","top-center",3);
    }*/

    _continuar = true;
    _crear = 'NO', _modificar = 'NO', _eliminar = 'NO';
    

    $('#btnNuevo').click(function(){        
        $.redirect('perfilnew.php', {'mensaje': ''});
    });

    $('#btnRegresar').click(function(){        
        $.redirect("perfil.php");
    });    

    $(document).on("click","#chkCrear",function(){
        if($("#chkCrear").is(":checked")){
            $("#lblCrear").text("SI");
            _crear = 'SI';
        }else{
            $("#lblCrear").text("NO");
            _crear = 'NO';
        }
    });

    $(document).on("click","#chkModificar",function(){
        if($("#chkModificar").is(":checked")){
            $("#lblModificar").text("SI");
            _modificar = 'SI';
        }else{
            $("#lblModificar").text("NO");
            _modificar = 'NO';
        }
    }); 
    
    $(document).on("click","#chkEliminar",function(){
        if($("#chkEliminar").is(":checked")){
            $("#lblEliminar").text("SI");
            _eliminar = 'SI';
        }else{
            $("#lblEliminar").text("NO");
            _eliminar = 'NO';
        }
    });
    
    $(document).on("click",".btnEditar",function(){        
        _fila = $(this).closest("tr");
        _data = $('#tabledata').dataTable().fnGetData(_fila);
        _id = _data[0];
        _perfil = _fila.find('td:eq(0)').text();
        //location.href='menuedit.php?id='+id; //POR METODO GET
        $.redirect('perfiledit.php', {'idperfil': _id}); //POR METODO POST
    });   

    //UPDATE ESTADO PERFIL BDD
    $(document).on("click",".chkEstadoPe",function(){ 
        let _rowid = $(this).attr("id");
        let _idperfil = _rowid.substring(3);
        let _check = $("#chk" + _idperfil).is(":checked");
        let _estaperfil;

        if(_check){
            _estaperfil = 'Activo';
            $("#btnEditar" + _idperfil).prop("disabled", "");
        }else 
        {
            _estaperfil = 'Inactivo';
            $("#btnEditar" + _idperfil).prop("disabled", "disabled");
           
        }

        $.ajax({
            url: "../db/perfilcrud.php",
            type: "POST",
            dataType: "json",
            data: {id: _idperfil, estado: _estaperfil, opcion: 2},
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
        _perfil = $(this).closest("tr").find('td:eq(0)').text(); 
        
        if(_id == 1){
            // alertify.warning('Perfil de Administrador no se puede Eliminar..!','mensaje', 2, function(){console.log('dismissed');});
            mensajesalertify("Perfil  Administrador no se puede Eliminar..!","W","top-right",3); 
        }else{
            $.ajax({
                url: "../db/consultadatos.php",
                type: "POST",
                dataType: "json",
                data: {tipo:12, auxv1:"", auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_id, auxi2:0, auxi3:0, auxi4:0, auxi5:0, 
                auxi6:0, opcion:0},
                success: function(data){
                    if(data[0].contar == "0"){
                        _continuar = true;
                    }else{
                        _continuar = false;
                    }
                    FunValidar(_continuar);
                },
                error: function (error){
                    console.log(error);
                }
            });
        }
    });

    function FunValidar(respuesta){
        if(!respuesta){

            mensajesalertify("Perfil tiene Menú/Tareas Asociadas..!!","W","top-right",3);
        }else{
     
        alertify.confirm('El Perfil sera eliminado..!!', 'Esta seguro de eliminar'+''+ _perfil +'..?', function(){ 


        $.ajax({
             url: "../db/consultadatos.php",
             type: "POST",
             dataType: "json",
             data: {tipo:15, auxv1:"", auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_id, auxi2:0, auxi3:0, auxi4:0, 
             auxi5:0, auxi6:0, opcion:0},
             success: function(data){
                    Swal.close();
                    TableData.row(_fila.parents('tr')).remove().draw();
                   
                    mensajesalertify("Perfil Eliminado..!","E","top-center",2);
                            },
                            error: function (error) {
                                console.log(error);
                            }                  
        });

      }
        , function(){});	
           }
    }

    $('#btnSave').click(function(){
        _perfil = $.trim($("#txtPerfil").val());
        _observacion = $.trim($("#txtDescripcion").val());
        _estado = "Activo";

        if(_perfil == '')
        {       

            mensajesalertify("Ingrese Nombre del Perfil..!!","W","top-right",3);  
            return;
        }

        var i = 0;

        $("input[type=checkbox]:checked").map(function(){
            if($(this).val() != 'on'){
                _result[i] = $(this).val();
                i++;
            }
        });

        if(i == 0)
        {
           
            mensajesalertify("Seleccione al menos un opción Menu/Tareal..!!","W","top-right",3);
            return;
        }

        $.ajax({
            url: "../db/consultadatos.php",
            type: "POST",
            dataType: "json",
            data: {tipo:14, auxv1:"", auxv2:_perfil, auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:0, auxi2:0, auxi3:0, auxi4:0, auxi5:0, auxi6:0, 
            opcion:0},
            success: function(data){                    
                if(data[0].contar == "0"){                         
                    _continuar = true;
                }else{                      
                    _continuar = false;
                }   
                FunGrabar(_continuar);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }); 
    
    function FunGrabar(respuesta){
        if(!respuesta){
            // alertify.warning('Nombre del Perfil ya Existe..!','mensaje', 2, function(){console.log('dismissed');});
            mensajesalertify("Nombre del Perfil ya Existe..!!","W","top-right",3);
        }else{
            $.ajax({
                url: "../db/perfilcrud.php",
                type: "POST",
                dataType: "json",
                data: {nombreperfil:_perfil, observacion:_observacion, result:_result, estado:_estado, crear:_crear, modificar:_modificar, 
                    eliminar:_eliminar, id:0, opcion:0},          
                success: function(data){                                        
                    $.redirect('perfil.php', {'mensaje': 'Guardado con Exito..!'}); 
                },
                error: function (error){
                    console.log(error);
                }                            
            });   
        }
    }
});