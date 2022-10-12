<?php
    require_once("mySQL/login.php");
    
    error_reporting(E_ALL);
	ini_set("display_errors", 1);

    $logged = false;

    //renvoie un bool pour savoir si on est authentifié
    function isAuthentificated(){
        global $logged;
        if($logged == true){
            return true;
        }
        return false;
    }

    //se connecter
    function connect(){
        global $logged;
        chifrPass();
        if(checkPass($_POST["login"],$_POST["pass"])){
            $logged = true;
        }

        return $logged;
    }

    //se déconnecter
    function disconnect(){
        if($logged==true){
            $_POST["login"]="";
            $logged=false;
        }

        return true;
    }

    //chiffrer le mot de passe
    function chifrPass(){
        $_POST["pass"] = hash('sha256',$_POST["pass"]);
    }
?>
