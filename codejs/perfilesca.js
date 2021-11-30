$(document).ready(function(){
    var _codigo, _descripcion, _count = 0, _result = [], _objeto, _estado, _continuar, 
    _estadoold,_descripcionold, _checked, tblperfil;



    $("#modalPARAMETER").draggable({
        handle: ".modal-header"
    });  

    $('#cboPerfil').select2();

    $('#btnRegresar').click(function(){        
        $.redirect("");
    });  

    tblperfil = $('#tblperfil').DataTable({
        "columnDefs": [{
            "data": null
        }     
    ],
        "language": {
        "emptyTable": "datos"
         }
    });

    

    

    $('#btnAgregar').click(function(){        
        
        _codigo = $('#cboPerfil').val();
        _descripcion = $.trim($('#txtDescripcion').val());
        _estado = 'Activo';
        _continuar = true;

        if(_codigo == '0')
        {
            mensajesalertify("Seleccione Tipo Perfil..!","W","top-center",5);
            return;
        }

        if(_descripcion == '')
        {
            mensajesalertify("Ingrese Descripción..!","W","top-center",5);
            return;
        }        

        $.each(_result,function(i,item)
        {
            if(item.arrydescripcion.toUpperCase() == _descripcion.toUpperCase())
            {                        
                mensajesalertify("Nombre ya Existe..!","E","bottom-center",5); 
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
            _output += '<td class="text-center">' + _estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + _count + '" value="' + _estado + '" /></td>';
            _output += '<td><div class="text-center"><div class="btn-group">'
            _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
            _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
            _output += '</tr>';
            
            $('#tblperfil').append(_output);

            _objeto = {
                arrycodigo : parseInt(_count),
                arrydescripcion : _descripcion,
                arryestado : _estado,
            }

            _result.push(_objeto);   
            $('#txtDescripcion').val('');            
            
        }   

    });

    $(document).on("click",".btnEdit",function(){
        $("#formPerfil").trigger("reset"); 
        row_id = $(this).attr("id");
        
        _descripcionold = $('#txtDescripcion' + row_id + '').val();
        _estadoold = $('#txtEstado' + row_id + '').val();         
      
        if(_estadoold == "Activo"){
            $("#chkEstado").prop("checked", true);
            $("#lblEstado").text("Activo");
        }else{
            $("#chkEstado").prop("checked", false);
            $("#lblEstado").text("Inactivo");
        }

        $('#txtDescripcionedit').val(_descripcionold);
        $("#header").css("background-color","#183456");
        $("#header").css("color","white");
        $(".modal-title").text("Editar Descripcion");       
        $("#modalPERFIL").modal("show");
    });

    $('#btnModificar').click(function(){        
        
        _continuar = false, _seguir = false;

        _descripcion = $.trim($('#txtDescripcionedit').val());

        if(_descripcion == '')
        {
            mensajesalertify("Ingrese Descripción..!","W","top-center",5);
            return;
        }        
        
        if(_descripcionold.toUpperCase() != _descripcion.toUpperCase())
        {
            $.each(_result,function(i,item)
            {
                if(item.arrydescripcion.toUpperCase() == _descripcion.toUpperCase())
                {                        
                    mensajesalertify("Descripción ya Existe..!","E","bottom-center",5); 
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
                arrycodigo : parseInt(row_id),
                arrydescripcion : _descripcion,
                arryestado : _estado,
            }            

            _result.push(_objeto);
            
            $("#modalPERFIL").modal("hide");
            
            $("tbody").children().remove();

            _result.sort((a,b) => a.arrycodigo - b.arrycodigo)

            $.each(_result,function(i,item){            
                _output = '<tr id="row_' + item.arrycodigo + '">';
                _output += '<td style="display: none;">' + item.arrycodigo  + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + item.arrycodigo  + '" value="' + item.arrycodigo  + '" /></td>';                
                _output += '<td>' + item.arrydescripcion + ' <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion' + item.arrycodigo  + '" value="' + item.arrydescripcion + '" /></td>';
                _output += '<td class="text-center">' + item.arryestado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + item.arrycodigo  + '" value="' + item.arryestado + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + item.arrycodigo  + '"><i class="fa fa-pencil-square-o"></i></button>';
                _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + item.arrycodigo  + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                _output += '</tr>';
                
                $('#tblperfil').append(_output);       
            }); 
            
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

    $("#chkEstado").click(function(){
        _checked = $("#chkEstado").is(":checked");
        if(_checked){
            $("#lblEstado").text("Activo");
            _estado = 'Activo';
        }else{
            $("#lblEstado").text("Inactivo");
            _estado = 'Inactivo';
        }
    });

    $(document).on("click",".btnDelete",function(){
        row_id = $(this).attr("id");
        _descripcion = $('#txtDescripcion' + row_id + '').val();

        alertify.confirm('El registro sera eliminado', 'Esta seguro de eliminar' +' '+ _descripcion +'..?' , function(){ 

            FunRemoveItemFromArr(_result, _descripcion);
            $('#row_' + row_id + '').remove();
            _count--;

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

    $('#btnSave').click(function(){

        _codigo = $('#cboperfil').val();

        if(_count == 0)
        {         
            mensajesalertify("Ingrese al menos una Descripción.!","W","top-center",5);
            return false;
        }
        
        $.ajax({
            url: "../db/perfilescacrud.php",
            type: "POST",
            dataType: "json",
            data: {codigo:_codigo, result:_result, opcion:0, id:_codigo},            
            success: function(data){
              
                if(data == '0'){

                     $.redirect('perfilescalifica.php', {'mensaje': 'Grabado con Exito..!'}); 
                    // mensajesalertify("Grabado con exito..!","S","bottom-center",5);
                }    
                            
            },
            error: function (error) {
                console.log(error);
            }                            
        }); 
    });   
        

    $('#cboPerfil').change(function(){
        _cboid = $(this).val(); //obtener el id seleccionado
        console.log(_cboid);
        tblperfil.clear().draw();
         if(_cboid !== '0'){
            $.ajax({
                url: "../db/perfilescacrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:1, id:_cboid},            
                success: function(data){
                    
                    _desactivar = 'disabled';
                    console.log(_desactivar);
                    //tblperfil.clear().draw();
                    $.each(data,function(i,item){                    
                        _id = parseInt(data[i].Codigo);
                        _desc = data[i].Descripcion;
                        _estado = data[i].Estado;
                    //     _boton = '<td><div class="text-center"><div class="btn-group"><button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit"' +
                    //     'id=' + _id + '><i class="fa fa-pencil-square-o"></i></button><button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete "' +
                    //    _desactivar + ' id=' + _id + '><i class="fa fa-trash-o"></i></button></div></div></td>'

                    //     tblperfil.row.add([_id, _desc, _estado, _boton]).draw();
                        _output = '<tr id="row_' + _id + '">';
                        _output += '<td style="display: none;">' + _id  + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _id  + '" value="' + _id + '" /></td>';                
                        _output += '<td>' + _desc + ' <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion' + _id  + '" value="' + _desc + '" /></td>';
                        _output += '<td class="text-center">' + _estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' +_id  + '" value="' + _estado + '" /></td>';
                        _output += '<td><div class="text-center"><div class="btn-group">'
                        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + _id  + '"><i class="fa fa-pencil-square-o"></i></button>';
                        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete " disabled id="' + _id  + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                        _output += '</tr>';
                        
                        $('#tblperfil').append(_output);  
                        
                        _objeto = {
                            arrycodigo : parseInt(_id),
                            arrydescripcion : _desc,
                            arryestado : _estado,
                        }            
            
                        _result.push(_objeto);                        
                        _count++;                       
                    }); 
                                     
                },
                error: function (error) {
                    console.log(error);
                  }
            }); 

          }
      
  });

});