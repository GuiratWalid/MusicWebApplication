<?php
    $display = null;
    if(isset($_GET['vkey'])){
        $Vkey=$_GET['vkey'];
        include('../tools/connexion.php');
        $query="SELECT verifier,vkey FROM users WHERE verifier=0 AND vkey='$Vkey' LIMIT 1";
        $result = $connexion->query($query); 
        if($result->num_rows==1){
            $query2="UPDATE users SET verifier=1 WHERE vkey='$Vkey'";
            $result2 = $connexion->query($query2); 
            if($result2){
                $display = "Compte vérifié avec succès !";
            }
            else{
                $display = "Erreur de vérification du compte !";
            }
        }
        else{
            $display = "Ce compte est invalid ou dèjà vérifié !";
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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../css/signup.css">
    <title>Vérification du compte</title>
</head>
<body>
<div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="../../images/music.png" alt="" />
                <h3>Vérification du compte !</h3>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading"><?php echo $display; ?></h3>
                        <div class="row register-form">
                            <div class="col-3"></div>
                            <p>Veuillez se connecter sur votre compte ?</p>
                            <div class="col-5"></div>
                            <form action="login.php">
                                <input type="submit" class="btn btn-primary mt-3" name="login" value="Se connecter" /><br />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>