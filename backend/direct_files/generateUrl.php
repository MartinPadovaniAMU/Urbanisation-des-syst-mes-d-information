<?php
    require_once("../helper.php");
    $origin = $_POST["origin"];
    $video_code = $_POST["id"];
    
    $config = file_get_contents('../config.json');
    $config = json_decode($config);
    $res = array();
    foreach($config->services as $serv){
        if($origine == $serv->nom){
            array_push($res,$serv->origin);
            array_push($res,$serv->adresse .  $video_code);
        }
    }
    
    if(isset($res)){
        sendMessage($res);
    }
    else{
        sendError("Erreur lors de la génération de l'url");
    }
?>