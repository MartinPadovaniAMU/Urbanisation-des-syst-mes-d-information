<?php
    require_once("../mySQL/video.php");
    require_once("../helper.php");

    $idu = $_POST["login"];
    $nom = $_POST["nomPlaylist"];
    if($logged==true){
        createPlaylist($idp,$nom);
        sendMessage("Playlist créée");
    }
    else{
        sendError("Non connecté");
    }
?>