<?php
    $error=NULL;
    $success = NULL;
    if(isset($_POST["changer"])){
        $email = $_POST["email"];
        include('../tools/connexion.php');
        $query = "select vkey from users where email = '".$email."'";
        $result = $connexion->query($query); 
        if($row=$result->fetch_assoc()){
            $Vkey = $row["vkey"];
            $dest = $email;
            $objet = "Mot de passe oublié !";
            $contenu="<h1 style=\"text-align:center; color:blue;\">Mot de passe oublié !</h1><br/>"
            ."<h4 style=\"text-align:center; color:gray;\">Music Application</h4><br/><br/>"
            ."<p>Pour modifier votre mot de passe, veuillez cliquez ici : "
            ."<a href=http://localhost/music/php/user/passwordForgotten.php?vkey=$Vkey>Vérification de compte</a></p>";
        
            include('sendMail.php');
            $retval = sendmail($objet, $contenu, $dest);
            if( $retval ) 
                $success = "Email envoyé avec succès !";
            else
                $error = "Echec d'envoyer un email !";
        }
        else{
            $error = "L'adresse email incorrecte !";
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
                <h3>Récupérez votre compte !</h3>
                <p>Vous devez envoyer un email pour changer votre mot de passe !</p>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Mot de passe oublié !</h3>
                        <div class="row register-form">
                            <div class="col-2"></div>
                            <form class="col-8" method="POST" action="">
                                <?php 
                                    if(!($success == null)){
                                        echo "<div class=\"alert alert-success text-center\">$success</div>";
                                    }
                                    if(!($error == null)){
                                        echo "<div class=\"alert alert-danger text-center\">$error</div>";
                                    }
                                ?>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        value="" required/>
                                </div>
                                <p>Veuillez retourner à la page de connexion ? <a href="login.php">se connecter</a></p>
                                <input type="submit" class="btnRegister" name="changer" value="Envoyer un email" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>