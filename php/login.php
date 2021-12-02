<?php 
$error=NULL;
if(isset($_POST['signin'])){
    //Get form data
    $login=$_POST['login'];
    $password=$_POST['password'];
    include('connexion.php');
    $query="SELECT * FROM users WHERE (username='$login' OR email='$login') AND password='$password' LIMIT 1";
    $result = $connexion->query($query); 
    if($result->num_rows==1){
        header("Location: ../index.php");
    }
    else{
        $error="Utilisateur introuvable !";
        echo $error;
        include('loginPage.php');
    }
}
?>
  

