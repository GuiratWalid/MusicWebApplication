<?php 
include('../tools/checkSession.php');
if(!check("admin")){
    $error=NULL;
    if(isset($_POST['signin'])){
        //Get form data
        $login=$_POST['login'];
        $password=$_POST['password'];
        $password=md5($password);
        include('../tools/connexion.php');
        $query="SELECT * FROM users WHERE (username='$login' OR email='$login') AND role ='admin' LIMIT 1";
        $result = $connexion->query($query); 
        if($result->fetch_assoc()){
            $query1="SELECT * FROM users WHERE (username='$login' OR email='$login') AND password='$password' AND role ='admin' LIMIT 1";
            $result1 = $connexion->query($query1); 
            if($row = $result1->fetch_assoc()){
                session_start();
                $_SESSION["userid"]=$row["userid"];
                if (isset($_POST["garder"])){
                    $array=array($login,$password);
                    $user=implode("%",$array);
                    setcookie ("user",$user,time()+ (10 * 365 * 24 * 60 * 60),"/");
                }
                header("Location: home.php");
            }
            else{
                $error="Mot de passe incorrect !";
            }
        }
        else{
            $error="Utilisateur introuvable !";
        }
    }
}
else{
    header("Location: home.php");
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
    <title>S'inscrire</title>
</head>

<body>
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="../../images/music.png" alt="" />
                <h3>Espace Administrateur</h3>
                <p>Cet espace est réservé seulement à l'administrateur !</p>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Se connecter</h3>
                        <div class="row register-form">
                            <div class="col-3"></div>
                            <form class="col-7" method="POST" action="">
                                <?php 
                                    if(!($error == null)){
                                        echo "<div class=\"alert alert-danger text-center\">$error</div>";
                                    }
                                ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="login" placeholder="Email ou username*"
                                        value="" required/>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Mot de passe *" value="" required/>
                                </div>
                                <div>
                                    <input type="checkbox" id="garder" name="garder">
                                    <label for="garder">Me rappeler</label>
                                </div>
                                <input type="submit" class="btnRegister" name="signin" value="Se connecter" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>