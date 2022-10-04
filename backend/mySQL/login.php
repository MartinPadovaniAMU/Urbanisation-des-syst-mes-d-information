<?php
    require_once("dbconnect.php");

	error_reporting(E_ALL);
	ini_set("display_errors", 1);

    function checkLogin($login){
    	global $PDO; 
        $table = "Utilisateur";
        $query = "SELECT login FROM $table WHERE login=?";
        $data = array($login);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
        $resultats = $statement->fetchAll( PDO::FETCH_ASSOC );

        return isset($resultats);
    }

    function verifPass($login, $pass){
    	global $PDO;
        $table = "Utilisateur";
        $query = "SELECT login FROM $table WHERE password=? and login=?";
        $data = array($pass,$login);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
        $resultats = $statement->fetchAll( PDO::FETCH_ASSOC );
		
        return isset($resultats);
    }
?>