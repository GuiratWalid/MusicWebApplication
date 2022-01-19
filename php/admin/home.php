<?php
    include("../tools/checkSession.php");
    if(check("admin")){
        include("../tools/connexion.php");
        $query1="delete from users where verifier = 0 and  date < NOW() - INTERVAL 1 DAY";
        $connexion->query($query1);
        echo "Page d'accueil de l'admin ";
    }
    else{
        header("Location: login.php");
    }
?>