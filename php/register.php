<?php 
$error=NULL;
if(isset($_POST['register'])){
    //Get form data
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
    $genre=$_POST['genre'];
    $username=$_POST['username'];
    $datenais=$_POST['datenais'];
    $lieu=$_POST['lieu'];
    $image=$_POST['image'];

    //Generate Vkey
    $Vkey=md5(time().$username);

    //Insert and account
    if($password !== $password2){
        $error="Mot de passe incorrect !";
        echo $error;
    }
    else{
        include('connexion.php');
        $query="SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = $connexion->query($query); 
        if($result->num_rows==1){
            $error="Le username doit être unique !";
            echo $error;
        }
        else{
            $query="SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = $connexion->query($query); 
            if($result->num_rows==1){
                $error="L'email doit être unique !";
                echo $error;
            }
            else{
                $query="insert into users (username,fullname,password,genre,lieu,datenais,email,image,vkey) values ('$username','$fullname','$password','$genre','$lieu','$datenais','$email','$image','$Vkey')";
                if (mysqli_query($connexion,$query)){
                    echo "Compte créé avec succès !\n Veuillez le vérifier avec votre email";
                    $to=$email;
                    $subject="Email de vérification";
                    $message="<a href='http://localhost/music/php/verify.php?vkey=$Vkey'>Vérification de compte</a>";
                    $headers="From:guiratguirat123@gmail.com \r\n";
                    $headers.="MIME-version: 1.0"."\r\n";
                    $headers.="Content-type:text/html;charset=UTF-8"."\r\n";
                    $retval = mail($to,$subject,$message,$headers);
                    if( $retval == true ) {
                        echo "Message sent successfully...";
                     }else {
                        echo "Message could not be sent...";
                     }
                    header('location:thankyou.php');
                }
            }
        }
    }
}
?>