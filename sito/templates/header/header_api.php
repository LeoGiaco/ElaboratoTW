<?php
require("../../bootstrap.php");

if(isset($_POST["request"])){
    switch ($_POST["request"]){
        case "exit":
            unset($_SESSION["user"]);
            $result="ok";
            break;

        case "getUser":
            $result = $_SESSION["user"]; 
            break;
        case "addNotification":
            if(isUserLoggedIn() && isset($_POST["utente"]) && isset($_POST["visualizzata"]) && isset($_POST["testo"]) && isset($_POST["tipologia"])){
                $dbh->addNotification($_POST["utente"], $_POST["tipologia"], $_POST["testo"], $_POST["visualizzata"], today());
            }
            $result = "ok";
            break;
    }

} 

header('Content-Type: application/json');
echo json_encode($result);
?>