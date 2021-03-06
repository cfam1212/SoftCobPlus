$(document).ready(function(){

    var _continuar = true, _result = [], i = 0, _nameoldperfil, _idperfil, _crear, _modificar, _eliminar, _estado, _checked, _nombreperfil,
    _observacion, _rowcollection;

    _nameoldperfil = $.trim($("#txtPerfil").val());
    _idperfil = $.trim($("#idPerfil").val());
    _crear = $("#lblCrear").text();
    _modificar = $("#lblModificar").text();
    _eliminar = $("#lblEliminar").text();
    _estado = 'Activo';

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
    
    $('#btnSave').click(function(){
        _nombreperfil = $.trim($("#txtPerfil").val());
        _observacion = $.trim($("#txtDescripcion").val());        

        if(_nombreperfil == '')
        {
            mensajesalertify("Ingrese Nombre del Perfil..!!","W","top-right",3);	    
            return;
        }

        if(_nameoldperfil != _nombreperfil){
            //BUSCAR SI EL NOMBRE DE PERFIL YA EXISTE
            $.ajax({
                url: "../db/consultadatos.php",
                type: "POST",
                dataType: "json",
                data: {tipo:14, auxv1:"", auxv2:_nombreperfil, auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:0, auxi2:0, auxi3:0, auxi4:0, 
                auxi5:0, auxi6:0, opcion:0},
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
        }else{
            FunGrabar(true);
        }
    }); 
    
    function FunGrabar(response){
        if(!response){
            
            mensajesalertify("Nombre del Perfil ya Existe..!!","W","top-right",3);	      
        }else{

            _rowcollection =  TableData.$('input[type="checkbox"]', {"page": "all"});
            _rowcollection.each(function(index,elem){
                if($(this).prop("checked") == true){
                    _result.push($(elem).val());
                }                
            });

            $.ajax({
                url: "../db/perfilcrud.php",
                type: "POST",
                dataType: "json",
                data: {nombreperfil:_nombreperfil, observacion:_observacion, result:_result, crear:_crear, modificar:_modificar, 
                    eliminar:_eliminar, id:_idperfil, opcion:1},            
                success: function(data){ 
                    $.redirect('perfil.php', {'mensaje': 'Actualizado con Exito..!!'}); 
                },
                error: function (error) {
                    console.log(error);
                }                            
            });   
        }
    }   
});