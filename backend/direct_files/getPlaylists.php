<?php
    require_once("../mySQL/video.php");
    require_once("../helper.php");

    $login = $_POST["idu"];
    $playlist_list = getPlaylists($login);

    if(isset($playlist_list)){
        sendMessage($playlist_list);
    }
    else{
        sendError("Erreur lors de la récupération des playlists");
    }
?>