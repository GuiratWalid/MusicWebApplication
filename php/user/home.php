<?php
    include("../tools/checkSession.php");
    if(check("user")){
        echo "Page d'accueil de l'utilisateur ".$_SESSION["userid"];
    }
    else{
        header("Location: login.php");
    }
?>