$(document).ready(function(){
    var _contactual,_contnueva,_contconfi;

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

        if(_lastname == '')
        {
        
            mensajesalertify("Ingrese Apellido del Usuario..!","W","top-center",5);
            return;
        }
        
        if(_login == '')
        {
           
            mensajesalertify("Ingrese Login..!","W","top-center",5);
            return;    
        }
        
        if(_password == '')
        {
            
            mensajesalertify("Ingrese Password..!","W","top-center",5);
            return;    
        }
               
        if(_perfil == '0')
        {
            
            mensajesalertify("Seleccione Perfil..!","W","top-center",5);
            return;    
        }

        if(_loginold != _login){
            $.ajax({
                url: "../db/consultadatos.php",
                type: "POST",
                dataType: "json",
                data: {tipo:20, auxv1:"", auxv2:_login, auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:0, auxi2:0, auxi3:0, auxi4:0, auxi5:0, 
                auxi6:0, opcion:0},
                success: function(data){                    
                    if(data[0].contar == "0"){                         
                        _continuar = true;
                    }else{                      
                        _continuar = false;
                    }   
                    FunGrabar(_continuar);
                },
                error: function (error){
                    console.log(error);
                }
            });
        }else{
            FunGrabar(true);
        }        
    });

});