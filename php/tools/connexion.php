<?php 
    $host="localhost";
    $root="root";
    $mdp="";
    $db="dbm";
    $connexion=new mysqli($host,$root,$mdp,$db);
    if (mysqli_connect_errno()) {
        echo "Erreur de connexion à la base de données !";
    }
?>
