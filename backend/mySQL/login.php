<?php
    require_once("dbconnect.php");
    $l = "test";
    function checkLogin($login){
        $table = "Utilisateur";
        $query = "SELECT login FROM $table WHERE login=?";
        $data = array($login);
        $statement = $PDO->prepare($query);
        $exec = $statement->execute($data);
        $resultats = $statement->fetchAll( PDO::FETCH_ASSOC );

        return isset($resultats);
    }

    function verifPass($login, $pass){
        $table = "Utilisateur";
        $query = "SELECT login FROM $table WHERE password=? and login=?";
        $data = array($password,$login);
        $statement = $PDO->prepare($query);
        $exec = $statement->execute($data);
        $resultats = $statement->fetchAll( PDO::FETCH_ASSOC );

        return isset($resultats);
    }
    if(checkLogin("test")){
        if(verifPass("test","compte2")){
            echo("Boule");
        }
        else{
            echo("Echec de boule");
        }
    }
    else{
        echo("Echec de bill");
    }

?>