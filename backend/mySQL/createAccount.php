<?php
    require_once("dbconnect.php");

    error_reporting(E_ALL);
	ini_set("display_errors", 1);

    function create($login, $pass){
        global $PDO; 
        $table = "Utilisateur";
        $query = "INSERT INTO $table VALUES (?,?,0)";
        $data = array($login,$pass);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
    }

    function delete($login){
        global $PDO;
        $table = "Utilisateur";
        $query = "DELETE FROM $table WHERE login=?";
        $data = array($login);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
    }

    function modify($login, $pass){
        global $PDO;
        $table = "Utilisateur";
        $query = "UPDATE $table SET password = ? WHERE login = ?";
        $data = array($pass, $login);
        $statement = $GLOBALS["PDO"]->prepare($query);
        $exec = $statement->execute($data);
    }
?>