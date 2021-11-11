$(document).ready(function(){
    var _codigo, _descripcion, _count = 0, _result = [], _objeto, _estado, _continuar, 
    _estadoold,_descripcionold, _checked;

    $('#cboperfil').select2();

    $('#btnRegresar').click(function(){        
        $.redirect("");
    });  

    $('#btnPerfiles').click(function(){        
        
        _codigo = $('#cboperfil').val();
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
            _output += '<td class="text-center">' + _descripcion + ' <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion' + _count + '" value="' + _descripcion + '" /></td>';
            _output += '<td class="text-center">' + _estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + _count + '" value="' + _estado + '" /></td>';
            _output += '<td><div class="text-center"><div class="btn-group">'
            _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
            _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
            _output += '</tr>';
            
            $('#tblperfil').append(_output);

            _objeto = {
                arrycodigo : _codigo,
                arrydescripcion : _descripcion,
                arryestado : _estado,
            }

            _result.push(_objeto);     
        }   

    });


    $(document).on("click",".btnEdit",function(){
        $("#formParam").trigger("reset"); 
        row_id = $(this).attr("id");
        _descripcionold = $('#txtDescripcion' + row_id + '').val();
        _estadoold = $('#txtEstado' + row_id + '').val(); 
        _tipoSave = 'edit';
      
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
        $("#modalPARAMETER").modal("show");
    });

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
    




});