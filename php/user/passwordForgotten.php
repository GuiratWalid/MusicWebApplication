<?php
    $error = null;
    $success = null;
    if(isset($_GET['vkey'])){
        $Vkey=$_GET['vkey'];
        include('../tools/connexion.php');
        if(isset($_POST['pwd'])){
            $password=$_POST['password'];
            $password1=$_POST['password1'];
            if($password !== $password1){
                $error="Mot de passe incorrect !";
            }
            else{
                $password=md5($password);
                $query2="UPDATE users SET password='$password' WHERE vkey='$Vkey'";
                $result2 = $connexion->query($query2); 
                if($result2){
                    $success = "Mot de passe changé avec succès !";
                }
                else{
                    $error = "Erreur de modification du mot de passe !";
                }
            }
        }
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
    <title>Changer le mot de passe</title>
</head>

<body>
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="../../images/music.png" alt="" />
                <h3>Mot de passe oublié !</h3>
                <p>Changer votre mot de passe et se connecter à votre compte dès maintenant !</p>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Changer votre mot de passe</h3>
                        <div class="row register-form">
                            <div class="col-3"></div>
                            <form class="col-7" method="POST" action="">
                                <?php 
                                    if(!($error == null)){
                                        echo "<div class=\"alert alert-danger\">$error</div>";
                                    }
                                    if(!($success == null)){
                                        echo "<div class=\"alert alert-success\">$success</div>";
                                    }
                                ?>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Mot de passe *" value="" required/>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password1"
                                        placeholder="Confirmer le mot de passe *" value="" required/>
                                </div>
                                <input type="submit" class="btnRegister" name="pwd" value="Changer" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>