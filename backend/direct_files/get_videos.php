<?php
    //(code, nom_video, origine, origine_long, score, miniature_de_la_video(voir document))

    //Liste finale à renvoyer
    $final_liste = array();

    
    //Récupération du fichier de config avec les services et les infos liées
    $config = file_get_contents('../config.json');
    $config = json_decode($config);
    
    //Préparation de la requête et formatage des espaces et caractères spéciaux
    $search = $_POST["search"];
    $search = str_replace(" ","+",$search);
    $search = str_replace("&","%26",$search);
    
    //Tri en fonction de : date, rating, relevance, title, viewCount
    $order = $_POST["order"];
    //Type de la recherche
    $type = $_POST["type"];

    
    $i=0;
    foreach($config->services as $serv){
        //Récupération de l'url de l'api
        $url_api = $config->services[$i]->api;
        $url_api = str_replace("QUERY", $search, $url_api);
        
        //Récupération du type de la requête
        $url_api = str_replace("TYPE",$type,$url_api);
        
        //Tri des requêtes (en fonction de la date ou des vues)
        $url_api = str_replace("ORDER",$order,$url_api);


        //On récupère la clé si on en a besoin
        if($config->services[$i]->pkey[0] == "yes"){
            $API_KEY = $config->services[$i]->pkey[1];
            $url_api = str_replace("APIKEY", $API_KEY, $url_api);
        }

        //Récupération des données de l'api en fonction du chemin d'accès défini dans le fichier de config
        $searchResponse = file_get_contents($url_api);
        $searchResponse = json_decode($searchResponse);
        $path = $config->services[$i]->path;
        $searchResponse = $searchResponse->$path;

        //Création d'un tableau qui contiendra toutes les data des vidéos
        $liste = array();
        
        $k = 0;
        //Récupération de 10 vidéos par service
        while($k <10){
            $name = $searchResponse[$k];
            //Récupération du nom de la vidéo
            foreach($config->services[$i]->name as $el){
                $name = $name->$el;
            }
            //Récupération de l'id de la vidéo
            $code = $searchResponse[$k];
            foreach($config->services[$i]->code as $el){
                $code = $code->$el;
            }
            //Changement du format de l'id de la vidéo
            $code = str_replace($config->services[$i]->format_code,"",$code);

            //Récupération de la miniature de la vidéo
            $miniature = $config->services[$i]->miniature;
            $miniature = str_replace("IDVID",$code,$miniature);
            
            //Récupération de l'origine de la vidéo dans le fichier de config
            $origine = $config->services[$i]->origin;
            //Récupération de l'origine long de la vidéo dans le fichier de config
            $origine_long = $config->services[$i]->nom;


            $score = "unknown";
            if($config->services[$i]->apiscore != "no"){
                $api_score = $config->services[$i]->apiscore;
                $score_path = $config->services[$i]->score;
                if($config->services[$i]->pkey[0] == "yes"){
                    $api_score = str_replace("APIKEY",$config->services[$i]->pkey[1],$api_score);
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
    
            //Positionnement des data de la vidéo dans le tableau
            array_push($liste, array('nom' => $name, 
                                'code' => $code, 
                                'origine' => $origine, 
                                'origine_long' => $origine_long,
                                'score' => $score,
                                'miniature' => $miniature));
            $k++;
        }
        print_r($liste);
        $i++;
    }
    

?>