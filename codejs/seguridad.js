$(document).ready(function(){
    var _contactual, _contnueva, _contconfi  , _usuaid, _continuar,_id;

    _usuaid = $.trim($("#txtusuaid").val());

  
    $('#btnSave').click(function(e){
        e.preventDefault();
        _contactual = $.trim($("#txtcontactual").val());
        _contnueva = $.trim($("#txtcontnueva").val());
        _contconfi = $.trim($("#txtconfcont").val());

        if(_contactual == '')
        {          
            mensajesalertify("Ingrese Contraseña Actual..!!","W","top-right",3);
            return;
        }

        if(_contnueva == '')
        {        
            mensajesalertify("Ingrese Nueva Contraseña..!!","W","top-right",3);
            return;
        }
        
        if(_contconfi == '')
        {           
            mensajesalertify("Confirme la Contraseña..!!","W","top-right",3);
            return;    
        }

        if(_contnueva != _contconfi ){
            mensajesalertify("Las contraseñas no son iguales..!!","E","top-right",3);
            return;    
        }

        $.ajax({
            url: "../db/consultadatos.php",
            type: "POST",
            dataType: "json",
            data: {tipo:24, auxv1:_contactual, auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_usuaid, auxi2:0, auxi3:0, auxi4:0, auxi5:0, 
            auxi6:0, opcion:0},
            success: function(data){       
                console.log(data);                           
                if(data[0].Codigo == '0'){
                    mensajesalertify("La contraseña actual es incorrecta..!!","E","top-right",3);
                    return;
                }else{ 
                    $.ajax({
                        url: "../db/consultadatos.php",
                        type: "POST",
                        dataType: "json",
                        data: {tipo:25, auxv1:_contnueva, auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_usuaid, auxi2:0, auxi3:0, auxi4:0, auxi5:0, 
                        auxi6:0, opcion:0},
                        success: function(data){                    
                            mensajesalertify("Actualizado con exito..!!","S","top-center",3);                       
                            $.trim($("#txtcontactual").val(''));
                            $.trim($("#txtcontnueva").val(''));
                            $.trim($("#txtconfcont").val(''));
                            
                        },
                        error: function (error){
                            console.log(error);
                        }
                    });                                                                 
                }                
            },
            error: function (error){
                console.log(error);
            }
        });                        
    }); 


    //Resetear Password
     $(document).on("click","#btnReset",function(){
        _fila = $(this).closest("tr");
        _data = $('#tabledata').dataTable().fnGetData(_fila);
        _id = _data[0];
        //console.log(_id);
        $.ajax({
            url: "../db/consultadatos.php",
            type: "POST",
            dataType: "json",
            data: {tipo:27, auxv1:"", auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_id, auxi2:0, auxi3:0, auxi4:0, auxi5:0, auxi6:0, 
            opcion:0},
            success: function(data){
                mensajesalertify("Password reseteado exitosamente..!!","S","top-center",3);   
            },
            error: function (error) {
                console.log(error);
            }                  
        });
    });
        

});