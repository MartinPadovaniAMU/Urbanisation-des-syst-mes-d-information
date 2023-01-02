<?php
    require_once("../mySQL/video.php");
    require_once("../helper.php");

    $action = $_POST["action"];
    if($logged == true){
        if($action == "del"){
            $idp = $_POST["idp"];
            $url = $_POST["url"];
            $login = $_POSt["login"];
            deleteVideo($idp,$url,$login);
            sendMessage("Vidéo supprimée");
        }
        if($action == "up"){
            $idp = $_POST["idp"];
            $url = $_POST["url"];
            up($idp,$url);
            sendMessage("Vidéo remontée");
        }
        if($action == "down"){
            $idp = $_POST["idp"];
            $url = $_POST["url"];
            down($idp,$url,$login);
            sendMessage("Vidéo descendue");
        }
    }
?>