<?php
    require_once("../auth.php");
    require_once("../helper.php");
    
    if(disconnect()){
        sendMessage("Disconnected");
    }
    else{
        sendError("Can't be disconnected if not connected");
    }
?>
