<?php 
include('../tools/checkSession.php');
if(!check("user")){
    $error=NULL;
    $success = NULL;
    if(isset($_POST['register'])){

        //upload image initialization
        $filename = md5(time());
        $filename .= $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];    
        $folder = "../../images/uploads/".$filename;

        //Get form data
        $fullname=$_POST['fullname'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $password2=$_POST['password2'];
        $genre=$_POST['genre'];
        $username=$_POST['username'];
        $datenais=$_POST['datenais'];
        $lieu=$_POST['lieu'];

        //Generate Vkey
        $Vkey=md5(time().$username);

        //Insert and account
        if($password !== $password2){
            $error="Mot de passe incorrect !";
        }
        else{
            $password = md5($password);
            include('../tools/connexion.php');
            $query="SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = $connexion->query($query); 
            if($result->num_rows==1){
                $error="L'email doit être unique !";
            }
            else{
                $query="SELECT * FROM users WHERE username='$username' LIMIT 1";
                $result = $connexion->query($query); 
                if($result->num_rows==1){
                    $error="Le username doit être unique !";
                }
                else{
                    $query="insert into users (username,fullname,password,genre,lieu,datenais,email,image,vkey) values ('$username','$fullname','$password','$genre','$lieu','$datenais','$email','$filename','$Vkey')";
                    //upload image
                    if (move_uploaded_file($tempname, $folder))  {
                        $success = "Image uploaded successfully";
                    }else{
                        $error = "Failed to upload image";
                }
                    if (mysqli_query($connexion,$query)){
                        include('sendMail.php');
                        $success = "Compte créé avec succès !\n Veuillez le vérifier avec votre email";
                        $subject="Email de vérification";
                        $message="<h1 style=\"text-align:center; color:blue;\">Vérification d'un compte</h1><br/>"
                        ."<h4 style=\"text-align:center; color:gray;\">Music Application</h4><br/><br/>"
                        ."<p>Pour vérifier votre compte, veuillez cliquez ici : "
                        ."<a href='http://localhost/music/php/user/verify.php?vkey=$Vkey'>Modifier le mot de passe</a></p>";
                        $retval=sendmail($subject, $message, $email);
                        if( $retval == true ) {
                            $msg = "Message sent successfully...";
                        }else {
                            $msg = "Message could not be sent...";
                        }
                        $success = "Compte créé avec succès ! Vous devez le vérifier avant 24 heures !";
                    }
                }
            }
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
                <h3>Bienvenue</h3>
                <p>Vous êtes à 30 secondes de créer votre playlist !</p>
                <form action="login.php">
                    <input type="submit" name="connexion" value="Connexion" /><br />
                </form>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Créer un compte</h3>
                        <form class="row register-form" action="" method="POST" enctype="multipart/form-data">
                            <div class="col-12 w-75">
                                <?php 
                                    if(!($error == null)){
                                        echo "<div class=\"alert alert-danger text-center\">$error</div>";
                                    }
                                    if(!($success == null)){
                                        echo "<div class=\"alert alert-success text-center\">$success</div>";
                                    }
                                ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="fullname"
                                        placeholder="Nom et prénom *" value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email *" value=""
                                        required />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Mot de passe *" value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password2"
                                        placeholder="Confirmer le mot de passe *" value="" required />
                                </div>
                                <div class="form-group">
                                    <div class="maxl">
                                        <label class="radio inline">
                                            <input type="radio" name="genre" value="homme" checked>
                                            <span>Homme</span>
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="genre" value="femme">
                                            <span>Femme</span>
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="genre" value="autre">
                                            <span>Autre</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username *"
                                        value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="date" name="datenais" class="form-control" placeholder="Your Phone *"
                                        value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lieu" placeholder="Lieu *" value=""
                                        required />
                                </div>
                                <div class="form-group">
                                    <input type="button" class="form-control"
                                        onclick="document.getElementById('img').click()" value="Importer une image" />
                                    <input type="file" id="img" name="image" style="display:none"
                                        accept="image/png, image/jpeg" class="form-control" />
                                </div>
                                <input type="submit" class="btnRegister" name="register" value="S'inscrire" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>