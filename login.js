$('#formLogin').submit(function(e){
    e.preventDefault();
    
    var usuario = $.trim($("#username").val()); 
    console.log(usuario);
    var password =$.trim($("#password").val());    
    if(usuario.length == "" || password == ""){
     
        mensajesalertify("ingrese usuario y/o password","W","top-center",5);
       return false; 
     }else{        
         $.ajax({
            url:"db/login.php",
            type:"POST",
            datatype: "json",
            data: {usuario:usuario, password:password}, 
            success:function(data){   
                console.log(data);              
                if(data == 'null'){
                 
                    mensajesalertify("usuario y/o password incorrecto","E","bottom-right",5);
                    $("#username").val('');
                    $("#password").val('');                    
                }else{
                    window.location.href = "dashmenu/panel_content.php";              
                }
            }    
         });
     }
 });