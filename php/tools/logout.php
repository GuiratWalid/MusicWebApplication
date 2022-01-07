<?php
    function logout($role){
        include("../tools/checkSession.php");
        if(check($role)){
            setcookie("user","",time()-10,"/");
            session_start();
            session_unset("userid");
            session_destroy();
        }
        header("Location: ../../index.php");
    }
    logout("user");
?>