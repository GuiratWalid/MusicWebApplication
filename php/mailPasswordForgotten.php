<?php
    include('sendMail.php');

    $dest = "guiratwalid98@gmail.com";
    $objet = "Mot de passe oublié !";
    $message="<a href='http://localhost/music/php/passwordForgotten.php?vkey=$Vkey'>Vérification de compte</a>";

    sendmail($message, $contenu, $dest);
?>