<?php

    function check ($role) {
        if(isset($_SESSION["userid"])){
            return true;
        }
        else{
            if(isset($_COOKIE["user"])){
                include("connexion.php");
                $user = $_COOKIE["user"];
                $array = explode("%",$user);
                $query="SELECT * FROM users WHERE (username='".$array[0]."' OR email='".$array[0]."') AND password='".$array[1]."' AND role ='".$role."' LIMIT 1";
                $result = $connexion->query($query); 
                if($row = $result->fetch_assoc()){
                    session_start();
                    $_SESSION["userid"] = $row["userid"];
                    return true;
                }
            }
        }
        return false;
    }

?>