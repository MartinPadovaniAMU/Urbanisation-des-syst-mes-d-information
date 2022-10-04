<?php
    require_once("config.php");
    
    
    $charset = "utf8";
    $dsn = "mysql:host=$host;" .
        "dbname=$dbname;" .
        "charset=$charset";

    $opt = array (
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false );

    try{
        #$PDO = new PDO($dsn, $dbuser, $dbpass, $opt);
        $db = new PDO('mysql:host=raphael-bertrand-etu.pedaweb.univ-amu.fr;dbname=b18011881;charset=utf8', 'b18011881', 'rkgq77x16MePdI1');
        echo("Connection succeed. \n");
    }
    catch (PDOException $e) {
        print "Erreur vous êtes non connecté ! erreur en cours : " . $e->getMessage() . "\n";
        die();
    }
?>
