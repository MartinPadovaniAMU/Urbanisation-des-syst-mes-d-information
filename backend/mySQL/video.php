<?php
    require_once("dbconnect.php");

	error_reporting(E_ALL);
	ini_set("display_errors", 1);


    function createPlaylist($login,$nom){
        global $PDO; 
        $table = "Video";
        $query = "INSERT INTO $table (idu,nom,url,suivant) VALUES (?,?,'','')";
        $data = array($login,$nom);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
    }

    function deletePlaylist($idPlaylist){
        global $PDO;
        $table = "Video";
        $query = "DELETE FROM $table WHERE idp=?";
        $data = array($idPlaylist);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
    }

    function getPlaylist($idp){
        global $PDO;
        $table = "Video";
        $query = "SELECT url FROM $table WHERE idp=?";
        $data = array($idp);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
    
        return($exec);
    }

    function getPlaylists($login){
        global $PDO;
        $table = "Video";
        $query = "SELECT idp FROM $table WHERE idu=?";
        $data = array($login);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);

        return($exec);
    }

    //Sert à changer le suivant du maillon
    function changeSuivant($idp,$url,$suivant){
        global $PDO;
        $table = "Video";
        $query = "UPDATE $table SET suivant = ? WHERE idp = ? AND url = ?";
        $data = array($suivant,$idp,$url);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
    }

    //Sert à chercher le maillon dont le suivant est l'url que l'on cherche
    function searchBefore($idp,$suivant){
        global $PDO;
        $table = "Video";
        $query = "SELECT url FROM $table WHERE suivant=? AND idp=?";
        $data = array($suivant, $idp);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);

        return($exec[0]);
    }

    function searchSuivant($idp,$url){
        global $PDO;
        $table = "Video";
        $query = "SELECT suivant FROM $table WHERE url=? AND idp=?";
        $data = array($url, $idp);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);

        return($exec[0]);
    }

    function compterVidéo($idp){
        global $PDO; 
        $table = "Video";
        $query = "SELECT COUNT(url) FROM $table WHERE idp=?";
        $data = array($idp);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);

        return $exec[0];
    }

    //Sert à ajouter une vidéo à une playlist
    function createVideo($idp,$url,$login){
        global $PDO; 
        if(compterVidéo($idp) != 0){
            changeSuivant($idp,searchBefore($idp,NULL),$url);
        }
        $table = "Video";
        $query = "INSERT INTO $table (idp,url,login) VALUES (?,?,?)";
        $data = array($idp,$url,$login);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
    }

    //Supprime la vidéo de la playlist
    function deleteVideo($idp,$url,$login){
        global $PDO;
        if(compterVidéo($idp) != 0){
            if(searchSuivant($idp,$url) != NULL){
                changeSuivant($idp,searchBefore($idp,$url),searchSuivant($idp,$url));
            }
            else{
                changeSuivant($idp,searchBefore($idp,$url),NULL);
            }
            $table = "Video";
            $query = "DELETE FROM $table WHERE url=? AND idp=?";
            $data = array($url,$idp);
            $statement = $GLOBALS["PDO"]->prepare($query);
            $exec = $statement->execute($data);
        }
    }

    //Reste à faire la partie up et down
    function up($url,$idp){
        $compte = compterVidéo($idp);
        if($compte > 1){
            $av = searchBefore($idp,$url);
            if($av == NULL){}
            else{
                $av_av = searchBefore($idp,$av);
                //cas où il y en a 2 avant
                if($av_av != NULL){
                    changeSuivant($idp,$av_av,$url);
                }
                $af = searchSuivant($idp,$url);
                if($af != NULL){
                    changeSuivant($idp,$av,$af);
                }
                else{
                    changeSuivant($idp,$av,NULL);
                }
                changeSuivant($idp,$url,$av);
            }
        }
    }
    
    function down($url,$idp){
        $compte = compterVidéo($idp);
        if($compte > 1){
            $af = searchSuivant($idp,$url);
            if($af == NULL){}
            else{
                $af_af = searchSuivant($idp,$af);
                //cas où il y en a 2 avant
                if($af_af != NULL){
                    changeSuivant($idp,$url,$af_af);
                }
                else{
                    changeSuivant($url,$url,NULL);
                }
                $av = searchBefore($idp,$url);
                if($av != NULL){
                    changeSuivant($idp,$av,$af);
                }
                changeSuivant($idp,$af,$url);
            }
        }
    }
    
?>