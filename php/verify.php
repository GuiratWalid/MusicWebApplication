<?php
    if(isset($_GET['vkey'])){
        $Vkey=$_GET['vkey'];
        include('connexion.php');
        $query="SELECT verifier,vkey FROM users WHERE verifier=0 AND vkey='$Vkey' LIMIT 1";
        $result = $connexion->query($query); 
        if($result->num_rows==1){
            $query2="UPDATE users SET verifier=1 WHERE vkey='$Vkey'";
            $result2 = $connexion->query($query2); 
            if($result2){
                echo "Compte vérifié avec succès !";
                //header("Location: ../index.php");
            }
            else{
                echo "Erreur de vérification du compte !";
            }
        }
        else{
            echo "Ce compte est invalid ou dèjà vérifié !";
            //header("Location: errorLogin.php");
        }
    }
    else{
        die('Code de vérification érroné !');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification du compte</title>
</head>
<body>
    
</body>
</html>