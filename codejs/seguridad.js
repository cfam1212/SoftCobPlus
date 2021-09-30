$(document).ready(function(){
    var _contactual,_contnueva,_contconfi  , _usuaid, _continuar;

    _usuaid = $.trim($("#txtusuaid").val());

    //alert(_usuaid);
    $('#btnRegresar').click(function(){
        $.redirect('../dashmenu/panel_content.php');
    });

    $('#btnSave').click(function(e){
        e.preventDefault();
        _contactual = $.trim($("#txtcontactual").val());
        _contnueva = $.trim($("#txtcontnueva").val());
        _contconfi = $.trim($("#txtconfcont").val());

        if(_contactual == '')
        {
          
            mensajesalertify("Ingrese Contraseña Actual..!","W","top-center",5);
            return;
        }

        if(_contnueva == '')
        {
        
            mensajesalertify("Ingrese Nueva Contraseña..!","W","top-center",5);
            return;
        }
        
        if(_contconfi == '')
        {
           
            mensajesalertify("Confirme la Contraseña..!","W","top-center",5);
            return;    
        }

        if(_contnueva != _contconfi ){
            mensajesalertify("Las contraseñas no son iguales..!","W","top-center",5);
            return;    
        }

        $.ajax({
            url: "../db/consultadatos.php",
            type: "POST",
            dataType: "json",
            data: {tipo:24, auxv1:_contactual, auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_usuaid, auxi2:0, auxi3:0, auxi4:0, auxi5:0, 
            auxi6:0, opcion:0},
            success: function(data){                    
                if(data[0].Codigo == "0"){                         
                    _continuar = false;
                
                }else{                      
                    _continuar = true;
                    if(_continuar){
                        $.ajax({
                            url: "../db/consultadatos.php",
                            type: "POST",
                            dataType: "json",
                            data: {tipo:25, auxv1:_contnueva, auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_usuaid, auxi2:0, auxi3:0, auxi4:0, auxi5:0, 
                            auxi6:0, opcion:0},
                            success: function(data){                    
                                mensajesalertify("Actualizado con exito..!","S","bottom-center",5);                       
                                $.trim($("#txtcontactual").val(''));
                                $.trim($("#txtcontnueva").val(''));
                                $.trim($("#txtconfcont").val(''));
                                
                            },
                            error: function (error){
                                console.log(error);
                            }
                        });
                    }else{
                        //mensajesalertify("Las contraseña actual es incorrecta..!","E","top-center",5); 
                    }     
                }   
                
            },
            error: function (error){
                console.log(error);
            }
        });
                        
    }); 


    

});