<?php
    require_once("newAccount.php");
    require_once("helper.php");
    
    if(!checkLogin($_POST["login"])){
        createAccount($_POST["login"],$_POST["pass"]);
        sendMessage("Account created!");
    }
    else{
        sendError("Username already existing");
    }
    
?>
