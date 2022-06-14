<?php
    @session_start();
    
    $_SESSION["s_usuario"] = "";
    $_SESSION["s_login"] = "";

    unset($_SESSION["s_login"]);
    
    @session_unset();
    @session_destroy();
    @session_write_close();
    @setcookie(session_name(),'',0,'/');
    @session_regenerate_id(true);
    
    header("Location: index.php");
    exit();
?>