$('#formLogin').submit(function(e){
    e.preventDefault();
    
    var usuario = $.trim($("#username").val()); 
    console.log(usuario);
    var password =$.trim($("#password").val());    
    if(usuario.length == "" || password == ""){
     
       alertify.warning('ingrese usuario y/o password');
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
                 
                    alertify.error('usuario y/o password incorrecto');
                    $("#username").val('');
                    $("#password").val('');                    
                }else{
                    window.location.href = "dashmenu/panel_content.php";              
                }
            }    
         });
     }
 });