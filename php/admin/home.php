<?php
    include("../tools/checkSession.php");
    if(check("admin")){
        echo "Page d'accueil de l'admin ";
    }
    else{
        header("Location: login.php");
    }
?>