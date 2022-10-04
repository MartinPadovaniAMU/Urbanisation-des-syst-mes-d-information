<?php
    require_once("mySQL/createAccount.php");

    error_reporting(E_ALL);
	ini_set("display_errors", 1);

    //créer un compte
    function createAccount(){
        chifrPass();
        create($_POST["login"],$_POST["pass"]);
    }

    //supprimer un compte
    function deleteAccount(){
        if($logged==true){
            delete($_POST["login"]);
            $_POST["login"]="";
            $logged = false;
        }
    }
?>