<?php
    require_once("mySQL/createAccount.php");
    require_once("auth.php");
    require_once("helper.php");

    error_reporting(E_ALL);
	ini_set("display_errors", 1);

    // créer un compte
    function createAccount($login, $pass){
        $_POST["pass"] = $pass;
        chifrPass();
        create($login, $_POST["pass"]);
    }

    //supprimer un compte
    function deleteAccount($login, $pass){
        if($logged==true){
            delete($login);
            $_POST["login"]="";
            $logged = false;
            return true;
        }
        else{
            return false;
        }
    }

    function modifiyPass($newPass){
        $_POST["pass"] = $newPass;
        $_POST["newPass"] = "";
        chifrPass();
        if(logged==true){
            modify($_POST["login"],$_POST["pass"]);
            return true;
        }
        else{
            return false;
        }
    }
?>
