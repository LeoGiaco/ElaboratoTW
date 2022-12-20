<?php

require("../../bootstrap.php");

if(isset($_POST["request"])){
    switch ($_POST["request"]) {
        case 'changePwd':
            if(isset($_POST["old"]) && isset($_POST["new"]))
            $rec = $dbh->checkPwd($_SESSION["user"], $_POST["old"]);
            if(count($rec)==1){
                $rec = $dbh->changePwd($_SESSION["user"], $_POST["new"]);
                if($rec){
                    $result["stato"] = true;
                    $result["msg"] = "Cambiamento password avvenuto con successo.";
                }
            } else {
                $result["stato"] = false;
                $result["msg"] = "La vecchia password non corrisponde.";
            }
            break;
    }
}


header('Content-Type: application/json');
echo json_encode($result);
?>