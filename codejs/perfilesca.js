$(document).ready(function(){
    var _codigo, _descripcion, _count = 0, _result = [], _objeto, _estado, _continuar, 
    _estadoold,_descripcionold, _checked;

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
    
                        _boton = '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-info btn-sm ml-3 btnEditar"' + _desactivar +
                                 ' id="btnEditar' + _id +'"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-outline-danger btn-sm ml-3 btnEliminar"' +
                                 ' id="btnEliminar"><i class="fa fa-trash-o"></i></button></div></div></td>'
                        
                        TableDataPerfilCalifica.row.add([_id, _desc, _boton, _newestado]).draw();
                    }
                                
                },
                error: function (error) {
                    console.log(error);
                }                            
            }); 
        }

        /*$.each(_result,function(i,item)
        {
            if(item.arrydescripcion.toUpperCase() == _descripcion.toUpperCase())
            {                        
                mensajesalertify("Nombre ya Existe..!","W","top-right",5); 
                _continuar = false;
                return false;
            }else{
                _continuar = true;
            }
        });

        if(_continuar)
        {
            _count++;
            _output = '<tr id="row_' + _count + '">';
            _output += '<td style="display: none;">' + _count + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _count + '" value="' + _codigo + '" /></td>';                
            _output += '<td>' + _descripcion + ' <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion' + _count + '" value="' + _descripcion + '" /></td>';
            _output += '<td><div class="text-center"><div class="btn-group">'
            _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
            _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
            _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + _count +
                       '" ' + _checked + ' value=' + _count + '/></div></td>';
            _output += '<td>' + 'Activo' + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' +  _count  + '" value="' + 'Activo' + '" /></td>';                       
            _output += '</tr>';
            
            $('#tblperfil').append(_output);

            _objeto = {
                arrycodigo : parseInt(_count),
                arrydescripcion : _descripcion,
                arryestado : 'Activo',
            }

            _result.push(_objeto);   
            $('#txtDescripcion').val('');            
            
        }*/   

    });

    $(document).on("click",".btnEdit",function(){
        $("#formPerfil").trigger("reset"); 
        row_id = $(this).attr("id");

        _id = row_id.substring(9);
        
        _descripcionold = $('#txtDescripcion' + _id + '').val();
        _estadoold = $('#txtEstado' + _id + '').val(); 
        
        alert(_estadoold);
      
        /*if(_estadoold == "Activo"){
            $("#chkEstado").prop("checked", true);
            $("#lblEstado").text("Activo");
        }else{
            $("#chkEstado").prop("checked", false);
            $("#lblEstado").text("Inactivo");
        }*/

        $('#txtDescripcionedit').val(_descripcionold);
        
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","white");
        $(".modal-title").text("Editar Descripcion");       
        $("#modalPERFIL").modal("show");
    });

    $('#btnModificar').click(function(){        
        
        _continuar = false, _seguir = false;

        _descripcion = $.trim($('#txtDescripcionedit').val());

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

            //alert(_estadoold);

            _objeto = {
                arrycodigo : parseInt(_id),
                arrydescripcion : _descripcion,
                arryestado : _estadoold
            } 

            _result.push(_objeto);

            console.log(_result);

            $("#modalPERFIL").modal("hide");

            $("tbody").children().remove();

            $("#tblperfil").empty();

            _output = '<thead>';
            _output += '<tr><th style="display: none; width:15%">Codigo</th>';
            _output += '<th style="width:25%">Descripcion</th><th style="width:20%; text-align: center">Opciones</th><th style="width:10%; text-align: center">Estado</th><th style="width:10% ; text-align: center">EstadoOculto</th></tr></thead>'
            $('#tblperfil').append(_output);  
            
            _output  = '<tbody>';
            $('#tblperfil').append(_output);                 

            _result.sort((a,b) => a.arrycodigo - b.arrycodigo)

            $.each(_result,function(i,item){   
                
                _checked = '';  

                if(item.arryestado == 'Activo'){
                    _checked = 'checked';
                }                

                _output = '<tr id="row_' + item.arrycodigo + '">';
                _output += '<td style="display: none;">' + item.arrycodigo  + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + item.arrycodigo  + '" value="' + item.arrycodigo  + '" /></td>';                
                _output += '<td>' + item.arrydescripcion + ' <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion' + item.arrycodigo  + '" value="' + item.arrydescripcion + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="btnEditar' + item.arrycodigo  + '"><i class="fa fa-pencil-square-o"></i></button>';
                _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + item.arrycodigo  + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                _output  += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoPe" id="chk' + item.arrycodigo +
                            '" ' + _checked + ' value=' + item.arrycodigo + '/></div></td>';
                _output += '<td>' + item.arryestado + ' <input type="text" name="hidden_estado[]" id="txtEstado' +  item.arrycodigo  + '" value="' + item.arryestado + '" /></td>';
                _output += '</tr>';
                
                $('#tblperfil').append(_output);
            }); 

            _output  = '</tbody>';
            $('#tblperfil').append(_output);  
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

    // $("#chkEstado").click(function(){
    //     _checked = $("#chkEstado").is(":checked");
    //     if(_checked){
    //         $("#lblEstado").text("Activo");
    //         _estado = 'Activo';
    //     }else{
    //         $("#lblEstado").text("Inactivo");
    //         _estado = 'Inactivo';
    //     }
    // });

    $(document).on("click",".btnDelete",function(){
        row_id = $(this).attr("id");
        _descripcion = $('#txtDescripcion' + row_id + '').val();

        alertify.confirm('El Perfil sera eliminado..!!', 'Esta seguro de eliminar' +' '+ _descripcion +'..?' , function(){ 

            FunRemoveItemFromArr(_result, _descripcion);
            $('#row_' + row_id + '').remove();
            _count--;
            mensajesalertify("Perfil Eliminado","E","top-center",5);

         }
        , function(){ });
    });

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

    /*$('#btnSave').click(function(){
        _codigo = $('#cboPerfil').val();
       
        if(_count == 0)
        {         
            mensajesalertify("Ingrese al menos una Descripción.!","W","top-right",5);
            return false;
        }
        
        $.ajax({
            url: "../db/perfilescacrud.php",
            type: "POST",
            dataType: "json",
            data: {codigo:_codigo, result:_result, opcion:0, id:_codigo},            
            success: function(data){
              
                if(data == '0'){

                     $.redirect('perfilescalifica.php', {}); 
                    // mensajesalertify("Grabado con exito..!","S","bottom-center",5);
                }    
                            
            },
            error: function (error) {
                console.log(error);
            }                            
        }); 
    });*/   
        

    $('#cboPerfil').change(function(){
        _cboid = $(this).val(); //obtener el id seleccionado

        $("#tblperfil").empty();

        _output = '<thead>';
        _output += '<tr><th style="display: none; width:15%">Codigo</th>';
        _output += '<th style="width:25%">Descripcion</th><th style="width:20%; text-align: center">Opciones</th><th style="width:10%; text-align: center">Estado</th><th style="width:10% ; text-align: center">EstadoOculto</th></tr></thead>'
        $('#tblperfil').append(_output);  
        
        _output  = '<tbody>';
        $('#tblperfil').append(_output);     
        
        if(_cboid != '0'){
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
                        
                        _newestado = '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoTa" id="chk' + _id +
                                     '" ' + _checked + ' value=' + _id + '/></div></td>';
    
                        _boton = '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-info btn-sm ml-3 btnEditar"' + _disabledit +
                                 ' id="btnEditar' + _id +'"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-outline-danger btn-sm ml-3 btnEliminar"' +
                                 'id="btnEliminar"><i class="fa fa-trash-o"></i></button></div></div></td>';

                        TableDataPerfilCalifica.row.add([_id, _desc, _boton, _newestado]).draw();
                        
                        /*_output = '<tr id="row_' + _id + '">';
                        _output += '<td style="display: none;">' + _id  + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _id  + '" value="' + _id + '" /></td>';                
                        _output += '<td>' + _desc + ' <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion' + _id  + '" value="' + _desc + '" /></td>';
                        _output += '<td><div class="text-center"><div class="btn-group">'
                        _output += '<button type="button" name="btnEdit" ' + _disabledit  + ' class="btn btn-outline-info btn-sm ml-3 btnEdit"  data-toggle="tooltip" data-placement="top" title="editar" id="btnEditar' + _id  + '"><i class="fa fa-pencil-square-o"></i></button>';
                        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete " disabled id="' + _id  + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                        _output  += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoPe" id="chk' + _id +
                                    '" ' + _checked + ' value=' + _id + '/></div></td>';
                        _output += '<td>' + _estado + ' <input type="text" name="hidden_estado[]" id="txtEstado' + _id  + '" value="' + _estado + '" /></td>';                                    
                        _output += '</tr>';

                        $('#tblperfil').append(_output);  
                        
                        _objeto = {
                            arrycodigo : parseInt(_id),
                            arrydescripcion : _desc,
                            arryestado : _estado,
                        }            
            
                        _result.push(_objeto);                        
                        _count++;  */                     
                    }); 
                                        
                },
                error: function (error) {
                    console.log(error);
                    }
            }); 
        }

        _output  = '</tbody>';
        $('#tblperfil').append(_output); 
      
  });


  $(document).on("click",".chkEstadoPe",function(){ 
    let _rowid = $(this).attr("id");
    let _idperfil = _rowid.substring(3);
    let _check = $("#chk" + _idperfil).is(":checked");

    _codigo = $('#cboPerfil').val();
       
    let _estadope;

    alert(_idperfil);


    if(_check){
        _estadope = 'A';
        $("#btnEditar" + _idperfil).prop("disabled", "");
        $("#txtEstado" + _idperfil).val("Activo");
       
    }else 
    {
        _estadope = 'I';
        $("#btnEditar" + _idperfil).prop("disabled", "disabled");
        $("#txtEstado" + _idperfil).val("Inactivo");
    }

    $.ajax({
        url: "../db/perfilescacrud.php",
        type: "POST",
        dataType: "json",
        data: {id: _idperfil, estado: _estadope, codigo: _codigo, opcion: 3},
        success: function(data){
           
        },
        error: function (error) {
            console.log(error);
        }                 
    });

  });

});