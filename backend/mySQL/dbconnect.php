<?php
    require_once("config.php");
    
    error_reporting(E_ALL);
	ini_set("display_errors", 1);

    $charset = "utf8";
    $dsn = "mysql:host=$host;" .
        "dbname=$dbname;" .
        "charset=$charset";

    $opt = array (
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false );

    try{
        $PDO = new PDO($dsn, $dbuser, $dbpass, $opt);
        echo("Connection succeed. \n");
    }

    catch (PDOException $e) {
        print "Erreur vous êtes non connecté ! erreur en cours : " . $e->getMessage() . "\n";
        die();
    }
?>
