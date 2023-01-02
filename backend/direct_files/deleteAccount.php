<?php
    require_once("../newAccount.php");
    require_once("../helper.php");
    
    if(deleteAccount($_POST["login"],$_POST["pass"])){
        sendMessage("Account deleted!");
    }
    else{
        sendError("User not connected");
    }
    
?>
