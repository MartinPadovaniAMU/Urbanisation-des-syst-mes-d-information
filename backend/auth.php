<?php
    require_once("mySQL/login.php");
    $logged = false;
    
    //renvoie un bool pour savoir si on est authentifié
    function isAuthentificated(){
        global $logged;
        if($logged == true){
            return true;
        }
        else{
            if(isset($_POST["login"]) and isset($_POST["pass"])){
                return authenticate();
            }
        }
        return false;
    }

    //s'authentifier
    function authenticate(){
        global $logged;
        if(checkPass($_POST["login"],$_POST["pass"])){
            $logged = true;
        }
        return $logged;
    }
?>