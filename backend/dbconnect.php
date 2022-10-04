<?php
    require_once(config.php);
    
    $host = "localhost";
    $charset = "UTF-8";
    $dsn = "mysql:host=" . $host ";" .
        "dbname=" . $dbname . ";" .
        "charset=" . $charset . ";";

    $opt = array (
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false );

    try{
        PDO = new PDO($dsn, $dbuser, $dbpass, $opt);
        echo("Connection succeed.");
    }
    catch (PDOException $e) {
        print "Erreur vous êtes non connecté ! erreur en cours : " . $e->getMessage() . "";
        die();
    }
?>
