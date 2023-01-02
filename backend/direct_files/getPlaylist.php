<?php
    require_once("../mySQL/video.php");
    require_once("../helper.php");

    $idp = $_POST["idp"];
    $playlist = getPlaylist($idp);

    if(isset($playlist)){
        foreach($playlist as $url){
            $config = file_get_contents("backend/config.json");
            $config = json_decode($config);
            $video = array();
            foreach($config->services as $serv){
                if(strpos($url,$serv->adresse)!==false){
                    $code = str_replace($serv->adresse,"",$url);
                    $origine = $serv->origin;
                    $origine_long = $serv->nom;
                    $miniature = $serv->miniature;
                    $miniature = str_replace("IDVID",$code,$miniature);
                    $titre = $serv->snippet;
                    if($serv->pkey[0] == "yes"){
                        $apikey = $serv->pkey[1];
                        $titre = str_replace("APIKEY",$apikey,$titre);
                    }
                    $titre = str_replace("IDVID",$code,$titre);
                    $titre = file_get_contents($titre);
                    $titre = json_decode($titre);
                    foreach($serv->titre as $el){
                        if(is_numeric($el)){
                            $titre = $titre[$el];
                        }
                        else{
                            $titre = $titre->$el;
                        }
                    }
                    //Récupérer le score de la vidéo
                    $score = "unknown";
                    if($serv->apiscore != "no"){
                        $api_score = $serv->apiscore;
                        $score_path = $serv->score;
                        if($serv->pkey[0] == "yes"){
                            $api_score = str_replace("APIKEY",$serv->pkey[1],$api_score);
                        }
                        $api_score = str_replace("IDVID",$code,$api_score);
                        $score = file_get_contents($api_score);
                        $score = json_decode($score); 
                        
                        foreach($score_path as $el){
                            if(is_numeric($el)){
                                $score = $score[$el];
                            }
                            else{
                                $score = $score->$el;
                            }
                        }
                    }
                    array_push($video_liste,array('nom' => $titre, 
                                            'code' => $code, 
                                            'origine' => $origine, 
                                            'origine_long' => $origine_long,
                                            'score' => $score,
                                            'miniature' => $miniature));
                }
            }
        }
    }
    else{
        sendError("Playlist non récupéré");
    }
        
    if(isset($video_liste[0])){
        sendMessage($video_liste);
    }
    else{
        sendError("Erreur lors de la récupération des vidéos de la playlist");
    }
?>