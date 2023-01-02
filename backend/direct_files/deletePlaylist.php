<?php
    require_once("../mySQL/video.php");
    require_once("../helper.php");

    $nom = $_POST["nomPlaylist"];
    if($logged == true){
        deletePlaylist($idp);
        sendMessage("Playlist détruite");
    }
    else{
        sendError("Non connecté");
    }
?>