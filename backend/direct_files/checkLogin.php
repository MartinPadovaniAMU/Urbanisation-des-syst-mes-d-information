<?php
    require_once("auth.php");
    require_once("helper.php");
    
    if(checkLogin($_POST["login"])){
        if(connect($_POST["login"],$_POST["pass"])){
            sendMessage("Connexion succeed");
        }
        else{
            sendError("Bad pass");
        }
    }
    else{
        sendError("Bad Username");
    }
    
?>
