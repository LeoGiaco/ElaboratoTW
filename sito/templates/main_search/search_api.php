<?php

require("../../bootstrap.php");

$result = array();
if(isset($_POST["request"])){
    switch ($_POST["request"]) {
        case "getResult":
            if(isUserLoggedIn() && isset($_POST["search"])){
                $result["dati"] = $dbh->getResultSearch($_POST["search"]);
            }
            break;
    }
}
header('Content-Type: application/json');
echo json_encode($result);


?>